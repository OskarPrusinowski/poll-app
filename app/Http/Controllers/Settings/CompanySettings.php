<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Services\Settings\CompanySettingsService;
use Illuminate\Http\Request;

class CompanySettings extends Controller
{
    public CompanySettingsService $companySettingsService;

    public function __construct(CompanySettingsService $companySettingsService)
    {
        $this->companySettingsService = $companySettingsService;
    }

    public function show($id)
    {
        $companySettings = $this->companySettingsService->getCompanySettigns($id);
        return response()->json(['companySettings' => $companySettings]);
    }

    public function create(Request $request)
    {
        $this->companySettingsService->createCompanySettings($request->get("companySettings"));
    }

    public function update(Request $request, $id)
    {
        $newCompanySettings = $request->get('companySettings');
        $this->companySettingsService->updateCompanySettings($newCompanySettings, $id);
    }
}
