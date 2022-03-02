<?php

namespace App\Models\Settings;

use App\Models\Companies\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['mail_tittle', 'mail_body', 'sms_body', 'company_id'];

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
