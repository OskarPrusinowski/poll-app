<?php

namespace App\Services\Companies;

use App\Models\Companies\Company;

class CompaniesService{

    protected Company $companyModel;

    public function __construct(Company $companyModel)
    {
        $this->companyModel=$companyModel;
    }

    public function getCompaniesList()
    {
        return $this->companyModel->all();
    }

}
