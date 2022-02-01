<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Users\UserController;



Route::get('/list',[UsersController::class,'index']);
Route::post('/delete',[UsersController::class,'destroyUsers']);


Route::get('/show/{id}',[UserController::class,'show']);
Route::post('/create',[UserController::class,'create']);
Route::delete('/delete/{id}',[UserController::class,'destroy']);
Route::put('/update/{id}',[UserController::class,'update']);




