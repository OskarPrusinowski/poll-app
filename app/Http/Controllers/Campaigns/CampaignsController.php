<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Services\Campaigns\CampaignsService;
use Illuminate\Http\Request;
use App\Http\Requests\Campaigns\PaginateCampaigns;

class CampaignsController extends Controller
{
    public CampaignsService $campaignsService;

    public function __construct(CampaignsService $campaignsService)
    {
        $this->campaignsService = $campaignsService;
        $this->middleware("permission:campaignsShow");
        $this->middleware("permission:campaignsManage");
    }

    public function getCampaigns(PaginateCampaigns $request, $companyId)
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
