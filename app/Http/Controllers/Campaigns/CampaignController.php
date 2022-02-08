<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Campaigns\CampaignService;

class CampaignController extends Controller
{
    public CampaignService $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService=$campaignService;
    }

    public function show($id)
    {
        $campaign=$this->campaignService->getCampaign($id);
        return response()->json(['campaign'=>$campaign]);
    }

    public function create(Request $request)
    {
        $campaign=$request->get("campaign");
        $this->campaignService->create($campaign);
    }

    public function addFile(Request $request)
    {
        $file=$request->file("file");
        $id=$request->id;
        $this->campaignService->addFile($file,$id);
    }

    public function release(Request $request)
    {
        $this->campaignService->releaseCampaign($request->get("campaign"));
    }

    public function update(Request $request,$id)
    {
        $campaign=$request->get("campaign");
        $this->campaignService->updateCampaign($campaign,$id);
    }
}
