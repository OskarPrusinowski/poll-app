<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateUpdateCompany;
use App\Services\Company\CompanyService;
use Illuminate\Http\Request;

class CompanysController extends Controller
{

    protected CompanyService $companyService;


    public function __construct(CompanyService $companyService)
    {
        $this->companyService=$companyService;
    }

    public function index()
    {
        $companys=$this->companyService->getCompanysList();
        return response()->json(['companys'=>$companys]);
    }


    public function create(CreateUpdateCompany $request)
    {
        $this->companyService->createCompany($request);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $company=$this->companyService->getCompany($id);
        return response()->json(['company'=>$company]);
    }


    public function edit($id)
    {
        //
    }


    public function update(CreateUpdateCompany $request)
    {
        $id=$request->id;
        $this->companyService->updateCompany($request,$id);
    }


    public function destroy($id)
    {
        $this->companyService->deleteCompany($id);
    }
}
