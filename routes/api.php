<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Users\UserController;

use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\Companies\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'/user'],function(){

    Route::get('/list',[UsersController::class,'index']);


    Route::get('/show/{id}',[UserController::class,'show']);
    Route::post('/create',[UserController::class,'create']);
    Route::delete('/delete/{id}',[UserController::class,'destroy']);
    Route::put('/update/{id}',[UserController::class,'update']);

});

Route::group(['prefix'=>'/company'],function(){

    Route::get('/list',[CompaniesController::class,'index']);

    Route::get('/show/{id}',[CompanyController::class,'show']);
    Route::post('/create',[CompanyController::class,'create']);
    Route::delete('/delete/{id}',[CompanyController::class,'destroy']);
    Route::put('/update/{id}',[CompanyController::class,'update']);
});

