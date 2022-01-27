<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService{

    protected User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel=$userModel;
    }

    public function getUsersList()
    {
        return $this->userModel->with("company")->get();
    }

    public function getUser($id)
    {
        return $this->userModel->find($id);
    }

    public function createUser(Request $request)
    {
        $user=$request->all()['user'];
        $this->userModel::create([
            'name' => $user['name'],
            'surname' => $user['surname'],
            'login' => $user['login'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'company_id'=>$user['company_id']
        ]);
        return true;
    }

    public function deleteUser($id)
    {
        $this->userModel->destroy($id);
    }

    public function updateUser(Request $request,$id)
    {
        $input=$request->all();
        $user=$this->getUser($id);
        $user->update($input['user']);
    }

}
