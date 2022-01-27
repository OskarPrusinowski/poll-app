<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\Company\CompanysController;

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
    Route::get('/show/{id}',[UsersController::class,'show']);

    Route::post('/create',[UsersController::class,'create']);

    Route::delete('/delete/{id}',[UsersController::class,'destroy']);

    Route::put('/update',[UsersController::class,'update']);

});

Route::group(['prefix'=>'/company'],function(){

    Route::get('/list',[CompanysController::class,'index']);

    Route::get('/show/{id}',[CompanysController::class,'show']);


    Route::post('/create',[CompanysController::class,'create']);

    Route::delete('/delete/{id}',[CompanysController::class,'destroy']);

    Route::put('/update',[CompanysController::class,'update']);
});

