<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Contacts\ContactsController;

Route::post('/import',[ContactsController::class,'importContacts']);