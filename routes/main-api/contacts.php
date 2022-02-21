<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Contacts\ContactsController;
use App\Http\Controllers\Contacts\ContactController;

Route::post('/import', [ContactsController::class, 'importContacts']);
Route::post('/anonymizate', [ContactsController::class, 'anonymizate']);

Route::post('/read/{id}', [ContactController::class, 'read'])->name('contact.read');
