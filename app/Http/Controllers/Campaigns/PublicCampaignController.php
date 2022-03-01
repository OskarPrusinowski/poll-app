<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Campaigns\CampaignService;
use Hashids\Hashids;

class PublicCampaignController extends Controller
{
    public CampaignService $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function getFile($id)
    {
        $file = $this->campaignService->getFile($id);
        return response($file, 200)
            ->header('Content-Type', 'application/pdf');
    }

    public function getHashedCampaign($id)
    {
        $hashids = new Hashids();
        $campaign = $this->campaignService->getCampaign($hashids->decode($id)[0]);
        return response()->json(['campaign' => $campaign]);
    }
}
