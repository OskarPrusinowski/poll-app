<?php

namespace App\Imports;

use App\Models\Contacts\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function model(array $row)
    {

        return new Contact([
            'name' => $row['e_mail'] ?? $row['numer_telefonu'],
            'email' => $row['e_mail'] ?? null,
            'phone_number' => $row['numer_telefonu'] ?? null,
            'campaign_id' => $this->companyId
        ]);
    }
}
