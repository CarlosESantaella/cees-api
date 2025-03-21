<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ProfileController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $perm): Response
    {
        $perm = ProfileController::getPermissionByName(strtoupper($perm));
        if (strtoupper($perm) != "NONE" && !is_null(strtoupper($perm))) {
            return $next($request);
        }
        return response()->json(['message' => 'Acceso denegado'], 401);
    }
}
