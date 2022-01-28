<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Services\Companies\CompaniesService;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    protected CompaniesService $companiesService;


    public function __construct(CompaniesService $companiesService)
    {
        $this->companiesService=$companiesService;
    }

    public function index()
    {
        $companies=$this->companiesService->getCompaniesList();
        return response()->json(['companies'=>$companies]);
    }


    
}
