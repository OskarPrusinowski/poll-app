<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CreateUpdateCompany;
use App\Services\Companies\CompanyService;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
        $this->middleware("permission:companiesShow");
        $this->middleware("permission:companiesManage");
    }

    public function create(CreateUpdateCompany $request)
    {
        $company = $request->get('company');
        $this->companyService->createCompany($company);
    }


    public function show($id)
    {
        $company = $this->companyService->getCompany($id);
        return response()->json(['company' => $company]);
    }


    public function update(CreateUpdateCompany $request, $id)
    {
        $newCompany = $request->get('company');
        $this->companyService->updateCompany($newCompany, $id);
    }


    public function destroy($id)
    {
        $this->companyService->deleteCompany($id);
    }
}
