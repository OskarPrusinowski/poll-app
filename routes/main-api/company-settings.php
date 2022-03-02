<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Settings\CompanySettings;

Route::get('/show/{id}', [CompanySettings::class, 'show']);
Route::post('/create', [CompanySettings::class, 'create']);
Route::put('/update/{id}', [CompanySettings::class, 'update']);
