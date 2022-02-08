<?php

namespace App\Services\Contacts;

use App\Models\Contacts\Contact;
use Excel;
use App\Imports\ContactImport;


class ContactsService{

    public Contact $contactModel;

    public function __construct(Contact $contactModel)
    {
        $this->contactModel=$contactModel;
    }

    public function importContacts($file,$id)
    {
        Excel::import(new ContactImport($id),$file);
        return true;
    }

    public function deleteContacts($id)
    {
        $this->contactModel->where('campaign_id',$id)->delete();
    }
}
