<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Services\Companies\CompaniesService;
use Illuminate\Http\Request;
use App\Http\Requests\Companies\DestroyCompanies;

class CompaniesController extends Controller
{
    protected CompaniesService $companiesService;


    public function __construct(CompaniesService $companiesService)
    {
        $this->companiesService = $companiesService;
    }

    public function index(Request $request)
    {
        $companies = $this->companiesService->getCompaniesList($request->page, $request->total);
        return response()->json(['companies' => $companies]);
    }

    public function destroyCompanies(DestroyCompanies $request)
    {
        $ids = $request->get("ids");
        $this->companiesService->deleteCompanies($ids);
    }

    public function getAmountCompanies()
    {
        $count = $this->companiesService->countCompanies();
        return response()->json(['count' => $count]);
    }
}
