<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService=$usersService;
    }

    public function index()
    {
        $users=$this->usersService->getUsersList();
        return response()->json(['users'=>$users]);
    }

    public function destroyUsers(Request $request)
    {
        $ids=$request->get("ids");
        $this->usersService->deleteUsers($ids);
    }
}
