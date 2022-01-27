<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyService{

    protected Company $companyModel;

    public function __construct(Company $companyModel)
    {
        $this->companyModel=$companyModel;
    }

    public function getCompanysList()
    {
        return $this->companyModel->all();
    }

    public function getCompany($id)
    {
        return $this->companyModel->find($id);
    }

    public function createCompany(Request $request)
    {
        $company=$request->all()['company'];
        $this->companyModel::create($company);
        return true;
    }

    public function deleteCompany($id)
    {
        $this->companyModel->destroy($id);
    }

    public function updateCompany(Request $request,$id)
    {
        $input=$request->all();
        $company=$this->getCompany($id);
        $company->update($input['company']);
    }

}
