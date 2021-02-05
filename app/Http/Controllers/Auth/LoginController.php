<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Login-Anfrage bearbeiten
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Login-Anfrage bestätigt
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        return response()->json(['message'=>'authenticated'], 200);

    }

    /**
     * login-Anfrage gescheitert
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw new AuthenticationException();
    }

    /**
     * Authenzifiziert
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

}
