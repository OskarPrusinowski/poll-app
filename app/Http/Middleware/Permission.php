<?php

namespace App\Http\Middleware;

use App\Services\Permissions\PermissionsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $perm=new PermissionsService();
        dd(Gate::allows('hasPermission'));
        if (Gate::allows('hasPermission')) {
            return "TAK";
        }
        return response()->json(['msg' => "wiadomość"], 403);
        return $next($request);
    }
}
