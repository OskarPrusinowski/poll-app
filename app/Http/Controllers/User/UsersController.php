<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUpdateUser;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{


    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function index()
    {
        $users=$this->userService->getUsersList();
        return response()->json(['users'=>$users]);
    }

    public function create(CreateUpdateUser $request)
    {
        $this->userService->createUser($request);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $user=$this->userService->getUser($id);
        return response()->json(['user'=>$user]);
    }

    public function edit($id)
    {
        //
    }


    public function update(CreateUpdateUser $request)
    {
        $id=$request->id;
        $this->userService->updateUser($request,$id);
    }

    
    public function destroy($id)
    {
        $this->userService->deleteUser($id);
    }
}
