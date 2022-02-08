<?php

namespace App\Services\Campaigns;

use App\Mail\CampaignMail;
use App\Models\Campaigns\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CampaignService{

    public Campaign $campaignModel;

    public function __construct(Campaign $campaignModel)
    {
        $this->campaignModel=$campaignModel;
    }

    public function create($campaign)
    {
        $this->campaignModel::create($campaign);
        return true;
    }

    public function getCampaign($id)
    {
        return $this->campaignModel->with("contacts")->find($id);
    }

    public function addFile($file,$id)
    {
        $file->storeAs("polls",$id.".pdf",'public');
        $campaign=$this->getCampaign($id);
        $campaign->file_name=$id.".pdf";
        $campaign->orginal_file_name=$file->getClientOriginalName();
        $campaign->save();
    }

    public function updateCampaign($newCampaign,$id)
    {
        $campaign=$this->getCampaign($id);
        $campaign->update($newCampaign);
    }

    public function releaseCampaign($campaign)
    {
        if($campaign['comunication_type']=='email'){
            $this->sendMail($campaign);
        }
        $campaign['date_published']=Carbon::now();
        $this->updateCampaign($campaign,$campaign['id']);
    }

    public function sendMail($campaign)
    {
        $contacts=$this->getCampaign($campaign['id'])->contacts;
        foreach($contacts as $contact){
            Mail::to($contact->email)->send(new CampaignMail($campaign));
        }
    }


}
