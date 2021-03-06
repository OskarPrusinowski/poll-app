<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Services\Contacts\ContactsService;
use Illuminate\Http\Request;
use App\Http\Requests\Contacts\ImportContacts;

class ContactsController extends Controller
{
    public ContactsService $contactsService;

    public function __construct(ContactsService $contactsService)
    {
        $this->contactsService = $contactsService;
        $this->middleware("permission:contactsShow");
        $this->middleware("permission:contactsManage");
    }

    public function importContacts(ImportContacts $request)
    {
        $campaignId = $request->id;
        $this->contactsService->deleteContacts($campaignId);
        $this->contactsService->importContacts($request->file, $campaignId);
    }

    public function anonymizate(Request $request)
    {
        $contacts = $request->contacts;
        $this->contactsService->anonymizate($contacts);
    }
}
