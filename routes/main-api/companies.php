<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\Companies\CompanyController;


Route::get('/list', [CompaniesController::class, 'index']);
Route::post('/delete', [CompaniesController::class, 'destroyCompanies']);
Route::get('/count', [CompaniesController::class, 'getAmountCompanies']);


Route::get('/show/{id}', [CompanyController::class, 'show']);
Route::post('/create', [CompanyController::class, 'create']);
Route::delete('/delete/{id}', [CompanyController::class, 'destroy']);
Route::put('/update/{id}', [CompanyController::class, 'update']);
