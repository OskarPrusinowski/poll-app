<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Services\Contacts\ContactService;
use Illuminate\Http\Request;
use Hashids\Hashids;

class ContactController extends Controller
{
    public ContactService $contactService;

    //Na razie bez sprawdzania permission bo to i tak jest publiczne

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
        //$this->middleware("permission:contactsShow");
        //$this->middleware("permission:contactsManage");
    }

    public function read($id)
    {
        $hashids = new Hashids();
        $this->contactService->readed($hashids->decode($id)[0]);
    }
}
