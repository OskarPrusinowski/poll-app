<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Services\Contacts\ContactsService;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public ContactsService $contactsService;

    public function __construct(ContactsService $contactsService)
    {
        $this->contactsService=$contactsService;
    }

    public function importContacts(Request $request)
    {
        $campaignId=$request->id;
        $this->contactsService->deleteContacts($campaignId);
        $this->contactsService->importContacts($request->file,$campaignId);
    }
}
