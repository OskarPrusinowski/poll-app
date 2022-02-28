<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Services\Contacts\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
        $this->middleware("permission:contactsShow");
        $this->middleware("permission:contactsManage");
    }

    public function read($id)
    {
        $this->contactService->readed($id);
    }
}
