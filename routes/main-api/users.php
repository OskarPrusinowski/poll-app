<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Users\UserController;

Route::group(['middleware' => ['auth:sanctum']], function () {
Route::get('/list', [UsersController::class, 'index']);
});

Route::post('/delete', [UsersController::class, 'destroyUsers']);
Route::get('/count', [UsersController::class, 'getAmountUsers']);

Route::post('/logout', [UserController::class, 'logoutApi']);
Route::get('/show/{id}', [UserController::class, 'show']);
Route::post('/create', [UserController::class, 'create']);
Route::delete('/delete/{id}', [UserController::class, 'destroy']);
Route::put('/update/{id}', [UserController::class, 'update']);
