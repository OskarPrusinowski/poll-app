<?php

namespace App\Models\Campaigns;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies\Company;
use App\Models\Contacts\Contact;

class Campaign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'comunication_type', 'file_name','company_id','date_registration','is_contact_list','file_name','orginal_file_name','date_published'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
