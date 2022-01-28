<?php 

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel=$userModel;
    }

    public function getUser($id)
    {
        return $this->userModel->find($id);
    }

    public function createUser($user)
    {
        $user['password']=Hash::make( $user['password']);
        $this->userModel::create($user);
        return true;
    }

    public function deleteUser($id)
    {
        $this->userModel->destroy($id);
    }

    public function updateUser($newUser,$id)
    {
        $user=$this->getUser($id);
        $user->update($newUser);
    }
}