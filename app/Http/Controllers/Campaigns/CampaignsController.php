<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Services\Campaigns\CampaignsService;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    public CampaignsService $campaignsService;

    public function __construct(CampaignsService $campaignsService)
    {
        $this->campaignsService = $campaignsService;
    }

    public function getCampaigns(Request $request, $companyId)
    {
        $campaigns = $this->campaignsService->getCamapigns($companyId, $request->page, $request->total);
        return response()->json(['campaigns' => $campaigns]);
    }

    public function getAmountCampaigns($companyId)
    {
        $count = $this->campaignsService->countCampaigns($companyId);
        return response()->json(['count' => $count]);
    }
}
