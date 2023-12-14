<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PermissionController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissions): Response
    {
        $user = Auth::user();
        $profile = Profile::findOrFail($user->profile);

        $permission = explode(':', $permissions)[0];
        $value = explode(':', $permissions)[1];

        if (isset($profile->permissions[$permission]) && $profile->permissions[$permission] === $value) {
            return $next($request);
        }

        return response()->json(['message' => 'Acceso no permitido'], 401);
    }
}
