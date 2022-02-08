<?php

namespace App\Imports;

use App\Models\Contacts\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $companyId;

    public function __construct($companyId)
    {
        $this->companyId=$companyId;
    }

    public function model(array $row)
    {
        return new Contact([
            'email'=>$row['e_mail'] ?? null,
            'phone_number'=>$row['phone_number'] ?? null,
            'campaign_id'=>$this->companyId
        ]);
    }
}
