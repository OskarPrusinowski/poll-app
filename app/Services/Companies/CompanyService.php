<?php

namespace App\Services\Companies;

use App\Models\Companies\Company;

class CompanyService{

    protected Company $companyModel;

    public function __construct(Company $companyModel)
    {
        $this->companyModel=$companyModel;
    }

    public function getCompany($id)
    {
        return $this->companyModel->find($id);
    }

    public function createCompany($company)
    {
        $this->companyModel::create($company);
        return true;
    }

    public function deleteCompany($id)
    {
        $this->companyModel->destroy($id);
    }

    public function updateCompany($newCompany,$id)
    {
        $company=$this->getCompany($id);
        $company->update($newCompany);
    }
}