<?php

namespace App\Services\Contacts;

use App\Models\Contacts\Contact;
use Carbon\Carbon;

class ContactService
{

    public Contact $contactModel;

    public function __construct(Contact $contactModel)
    {
        $this->contactModel = $contactModel;
    }

    public function readed($id)
    {
        $contact = $this->getContact($id);
        $campaign = $contact->campaign;
        if (Carbon::now() < $campaign->date_registration) {
            $contact->is_readed = true;
            $contact->save();
        }
    }

    public function getContact($id)
    {
        return $this->contactModel->with("campaign")->find($id);
    }

    public function updateContact($newContact, $id)
    {
        $contact = $this->getContact($id);
        $contact->update($newContact);
    }
}
