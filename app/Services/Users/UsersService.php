<?php

namespace App\Services\Users;

use App\Models\User;

class UsersService{

    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel=$userModel;
    }

    public function getUsersList()
    {
        return $this->userModel->with("company")->get();
    }

    public function deleteUsers($ids)
    {
        $this->userModel->destroy($ids);
        return true;
    }

}
