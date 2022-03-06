<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use Google2FA;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class Verifyg2fa extends Controller
{
    public function verify(Request $request)
    {
        $authenticator = app(Authenticator::class)->boot($request);
        if ($authenticator->isAuthenticated()) {
            return view("welcome");
        }
        return view("google2fa.index")->with('errors', ["Błędny kod"]);
    }
}
