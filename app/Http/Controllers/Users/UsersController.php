<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\UsersService;

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

}
