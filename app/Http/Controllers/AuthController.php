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
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $request->username)->with('profile_data')->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario o contraseña inválido'], 401);
        }
        $credentials = [
            "email" => $user->email,
            "password" => $request->password
        ];
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Usuario o contraseña inválido'], 401);
        }

        return response()->json([
            'access_token' => $this->createToken($user),
            'user' => $user
        ]);
    }

    public function me()
    {
        $user = User::where('id', Auth::user()->id)->with('profile_data')->first();
        return response()->json($user);
    }

    protected function createToken($user)
    {
        return JWTAuth::fromUser($user);
    }   
}
