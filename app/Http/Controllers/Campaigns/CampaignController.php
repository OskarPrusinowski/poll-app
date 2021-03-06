<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Campaigns\CampaignService;
use App\Http\Requests\Campaigns\CreateCampaign;
use App\Http\Requests\Campaigns\AddFileCampaign;

class CampaignController extends Controller
{
    public CampaignService $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
        $this->middleware("permission:campaignsShow");
        $this->middleware("permission:campaignsManage");
    }

    public function show($id)
    {
        $campaign = $this->campaignService->getCampaign($id);
        return response()->json(['campaign' => $campaign]);
    }

    public function create(CreateCampaign $request)
    {
        $campaign = $request->get("campaign");
        $this->campaignService->create($campaign);
    }

    public function addFile(AddFileCampaign $request)
    {
        $file = $request->file("file");
        $id = $request->id;
        $this->campaignService->addFile($file, $id);
    }

    public function release(Request $request)
    {
        $this->campaignService->releaseCampaign($request->get("campaign"));
    }

    public function destroy($id)
    {
        $this->campaignService->destroyCampaign($id);
    }

    public function update(Request $request, $id)
    {
        $campaign = $request->get("campaign");
        $this->campaignService->updateCampaign($campaign, $id);
    }

    public function getCampaignContacts($id)
    {
        $contacts = $this->campaignService->getContacts($id);
        return response()->json(['contacts' => $contacts]);
    }

    public function destroyFile($id)
    {
        $this->campaignService->deleteFile($id);
    }
}
