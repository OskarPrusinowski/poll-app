<?php

namespace App\Services\Companies;

use App\Models\Companies\Company;

class CompaniesService
{

    protected Company $companyModel;

    public function __construct(Company $companyModel)
    {
        $this->companyModel = $companyModel;
    }

    public function getCompaniesList($page, $total)
    {
        return $this->companyModel->limit($total)->offset(($page - 1) * $total)->get();
    }


    public function deleteCompanies($ids)
    {
        $this->companyModel->destroy($ids);
        return true;
    }

    public function countCompanies()
    {
        return $this->companyModel->get()->count();
    }
}
