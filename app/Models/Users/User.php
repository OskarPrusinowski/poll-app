<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Companies\Company;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone_number',
        'password',
        'company_id',
        'role_id',
        'google2fa_secret'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }

    public function getGoogle2faSecretAttribute($value)
    {
        return decrypt($value);
    }

    public function scopeFiltrByRole($query, $roleId)
    {
        return $query->where('role_id', $roleId);
    }

    public function scopeOwnPaginate($query, $page, $total)
    {
        return $query->limit($total)->offset(($page - 1) * $total);
    }
}
