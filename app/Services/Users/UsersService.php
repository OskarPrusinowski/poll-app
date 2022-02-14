<?php

namespace App\Services\Users;

use App\Models\Users\User;

class UsersService
{

    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getUsersList($page, $total)
    {
        return $this->userModel->with("company")->limit($total)->offset(($page - 1) * $total)->get();
    }

    public function deleteUsers($ids)
    {
        $this->userModel->destroy($ids);
        return true;
    }

    public function countUsers()
    {
        return $this->userModel->get()->count();
    }
}
