<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/complete-registration', [App\Http\Controllers\Auth\RegisterController::class, 'completeRegistration'])->name('complete-registration');

Route::get('/campaigns/read/{campaignIid}/{contactId}', function () {
    return view('welcome');
})->where('any', '.*');
Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', '2fa'])->group(function () {
    Route::get('/{any}', function () {
        return view('welcome');
    })->where('any', '.*');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/google2fa/authenticate', [App\Http\Controllers\Auth\Verifyg2fa::class, 'verify']);
