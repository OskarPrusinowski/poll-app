<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;
use App\Http\Requests\Users\DestroyUsers;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    protected UsersService $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
        $this->middleware("permission:usersShow");
        $this->middleware("permission:usersManage");
    }

    public function index(Request $request)
    {
        $users = $this->usersService->getUsersList($request->page, $request->total);
        return response()->json(['users' => $users]);
    }

    public function destroyUsers(DestroyUsers $request)
    {
        $ids = $request->get("ids");
        $this->usersService->deleteUsers($ids);
    }

    public function getAmountUsers()
    {
        $count = $this->usersService->countUsers();
        return response()->json(['count' => $count]);
    }
}
