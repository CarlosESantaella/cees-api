<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 401);
            }
            $token = Str::random(60);
            $token = hash('sha256', $token);
            $user->token_reset_password = $token;
            $user->save();
            $resetUrl = env('SITE_URL', 'http://localhost:4200').'/system/auth/reset-password?token=' . $token;
            Mail::send('emails.reset-password', ['resetUrl' => $resetUrl], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject("Reseteo de contraseña");
            });
            return response()->json(['message' => 'Email enviado correctamente'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Email no válido'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('token_reset_password', $request->token)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 401);
        }
        $user->password = $request->password;
        $user->token_reset_password = null;
        $user->save();
        return response()->json(['message' => 'Contraseña actualizada'], Response::HTTP_OK);
    }

    public function validateResetPasswordToken(Request $request)
    {
        $user = User::where('token_reset_password', $request->token)->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 401);
        }
        return response()->json(['message' => 'Token valido'], Response::HTTP_OK);
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
