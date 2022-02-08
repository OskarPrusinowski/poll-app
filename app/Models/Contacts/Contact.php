<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Campaigns\Campaign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['email','phone_number','campaign_id'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
