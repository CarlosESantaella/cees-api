<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Email o contraseña inválido'], 401);
        }

        $user = User::where('email', $request->email)->with('profile_data')->first();
        return response()->json([
            'access_token' => $this->createToken($user),
            'user' => $user
        ]);
    }

    protected function createToken($user)
    {
        return JWTAuth::fromUser($user);
    }
}
