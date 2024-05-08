<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(["message" => "login success"], 200);
        } else {
            return back()->withErrors(['message' => 'incorrect email or password']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(["message" => "logout success"], 200);
    }
}