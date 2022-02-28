<?php

namespace App\Services\Campaigns;

use App\Models\Campaigns\Campaign;

class CampaignsService
{

    public Campaign $campaignModel;

    public function __construct(Campaign $campaignModel)
    {
        $this->campaignModel = $campaignModel;
    }

    public function getCamapigns($companyId, $page, $total)
    {
        $campaigns = $this->campaignModel->filtrByCompany($companyId)->orderBy('created_at', 'desc')->limit($total)->offset(($page - 1) * $total)->get();
        return $campaigns;
    }

    public function countCampaigns($companyId)
    {
        return $this->campaignModel->filtrByCompany($companyId)->get()->count();
    }
}
