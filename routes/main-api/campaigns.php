<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Campaigns\CampaignController;
use App\Http\Controllers\Campaigns\CampaignsController;

Route::get('/list/{comapnyId}', [CampaignsController::class, 'getCampaigns']);
Route::get('/count/{comapnyId}', [CampaignsController::class, 'getAmountCampaigns']);


Route::post('/create', [CampaignController::class, 'create']);
Route::post('/add', [CampaignController::class, 'addFIle']);
Route::post('/release', [CampaignController::class, 'release']);
Route::post('/update/{id}', [CampaignController::class, 'update']);
Route::get('/show/{id}', [CampaignController::class, 'show']);
Route::delete('/delete/{id}', [CampaignController::class, 'destroy']);
