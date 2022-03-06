<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUpdateUser;
use App\Services\Users\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware("permission:usersShow");
        $this->middleware("permission:usersManage");
    }


    public function create(CreateUpdateUser $request)
    {
        $newUser = $request->get('user');
        $this->userService->createUser($newUser);
    }

    public function show($id)
    {
        $user = $this->userService->getUser($id);
        return response()->json(['user' => $user]);
    }

    public function update(CreateUpdateUser $request, $id)
    {
        $newUser = $request->get('user');
        $this->userService->updateUser($newUser, $id);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
    }

    public function getToken($id)
    {
        $user = $this->userService->getUser($id);
        $token = $user->createToken('auth-token')->plainTextToken;
        //dd($token);
    }

    public function getPermissions($id)
    {
        $permissions = $this->userService->getUser($id)->role->permissions;
        return response()->json(['permissions' => $permissions]);
    }
}
