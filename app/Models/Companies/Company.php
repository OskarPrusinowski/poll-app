<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class Company extends Model
{
    use HasFactory,softDeletes;

    protected $fillable=[
        'name',
        'compressed_name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
