<?php

namespace App\Services\Campaigns;


use App\Mail\CampaignMail;
use App\Models\Campaigns\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;


class CampaignService
{

    public Campaign $campaignModel;

    public function __construct(Campaign $campaignModel)
    {
        $this->campaignModel = $campaignModel;
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

    public function addFile($file, $id)
    {
        $file->storeAs("polls", $id . ".pdf", 'public');
        $campaign = $this->getCampaign($id);
        $campaign->file_name = $id . ".pdf";
        $campaign->orginal_file_name = $file->getClientOriginalName();
        $campaign->save();
    }

    public function updateCampaign($newCampaign, $id)
    {
        $campaign = $this->getCampaign($id);
        $campaign->update($newCampaign);
    }

    public function releaseCampaign($campaign)
    {
        if ($campaign['comunication_type'] == 'email') {
            $this->sendMail($campaign);
        } else {
            $this->sendSms($campaign);
        }
        $campaign['date_published'] = Carbon::now();
        $this->updateCampaign($campaign, $campaign['id']);
    }

    public function sendMail($campaign)
    {
        $contacts = $this->getCampaign($campaign['id'])->contacts;
        foreach ($contacts as $contact) {
            Mail::to($contact->email)->send(new CampaignMail($campaign, $contact));
        }
    }

    public function sendSms($campaign)
    {
        $contacts = $this->getCampaign($campaign['id'])->contacts;
        foreach ($contacts as $contact) {
            $client = new Client(env("TWILIO_SID"), env("TWILIO_TOKEN"));
            $number = "+48" . $contact->phone_number;
            $client->messages->create(
                $number,
                [
                    'from' => env("TWILIO_FROM"),
                    'body' => 'Hello from Twilio!'
                ]
            );
        }
    }

    public function destroyCampaign($id)
    {
        $this->campaignModel->destroy($id);
        return true;
    }

    public function getContacts($id)
    {
        $campaign = $this->getCampaign($id);
        return $campaign->contacts;
    }

    public function getFile($id)
    {
        $campaign = $this->getCampaign($id);
        return Storage::disk('public')->get('polls/' . $campaign->file_name);
    }

    public function deleteFile($id)
    {
        $campaign = $this->getCampaign($id);
        Storage::disk('public')->delete("polls/" . $campaign->file_name);
        $campaign->file_name = null;
        $campaign->orginal_file_name = null;
        $campaign->save();
    }
}
