<?php

namespace App\Services\Permissions;

use App\Models\Users\User;

class PermissionsService
{

    public function checkPermission(User $user,$permission)
    {
        dd($permission);
    }

    public function all()
    {
        dd("all");
    }
}
