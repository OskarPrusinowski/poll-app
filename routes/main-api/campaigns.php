<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Campaigns\CampaignController;


Route::post('/create',[CampaignController::class,'create']);

Route::post('/add',[CampaignController::class,'addFIle']);
Route::post('/release',[CampaignController::class,'release']);
Route::post('/update/{id}',[CampaignController::class,'update']);

Route::get('/show/{id}',[CampaignController::class,'show']);