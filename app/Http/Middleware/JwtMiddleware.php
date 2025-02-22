<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->input('token');
        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->toUser();
            } catch (Exception $e) {
                return response()->json(['error' => 'Token inválido'], 401);
            }
        } else {
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json(['error' => 'Token inválido'], 401);
                } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return response()->json(['error' => 'Token expirado'], 401);
                } else {
                    return response()->json(['error' => 'Token no proporcionado'], 401);
                }
            }
        }

        return $next($request);
    }
}