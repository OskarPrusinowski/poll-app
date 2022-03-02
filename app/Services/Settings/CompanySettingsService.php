<?php

namespace App\Services\Settings;

use App\Models\Settings\CompanySettings;

class CompanySettingsService
{

    public CompanySettings $companySettings;

    public function __construct(CompanySettings $companySettings)
    {
        $this->companySettings = $companySettings;
    }

    public function getCompanySettigns($id)
    {
        return $this->companySettings->find($id);
    }

    public function createCompanySettings($companySettings)
    {
        $companySettings['company_id'] = 1;
        $companySettings = $this->companySettings::create($companySettings);
        $companySettings->company_id = $companySettings->id;
        $companySettings->save();
    }

    public function updateCompanySettings($newCompanySettings, $id)
    {
        $companySettings = $this->getCompanySettigns($id);
        $companySettings->update($newCompanySettings);
    }
}
