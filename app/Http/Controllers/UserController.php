<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStorePostRequest;
use App\Models\Configuration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE USERS");
        
        if ($perm == "All") return User::where('profile', env('ID_PROFILE_ADMIN', 2))->get();
        if ($perm == "Own") return User::where('owner', Auth::user()->owner ?? Auth::user()->id)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStorePostRequest $request)
    {
        try {
            $data = $request->only(['name', 'username', 'email', 'password', 'profile']);
            $user_data = User::where('id', Auth::user()->id)->with('profile_data')->first();
            $is_super_admin = $user_data->profile_data->name == "Super Admin";
            $data['owner'] = ($is_super_admin) ? null : Auth::user()->owner ?? Auth::user()->id;
            $data['profile'] = ($is_super_admin) ? env('ID_PROFILE_ADMIN', 2) : $data['profile'];
            $perm = ProfileController::getPermissionByName("MANAGE USERS");
            
            // If profile is Super Admin or Admin
            if (in_array($data['profile'], [env('ID_PROFILE_SUPER_ADMIN', 1), env('ID_PROFILE_ADMIN', 2)]) && $perm == "Own") {
                return response()->json(["errors" => ['profile' => 'No tiene permisos para asignar este perfil']], 403);
            }

            $user = User::create($data);
            if($data['profile'] == 2){
                Configuration::create(['user_id' => $user->id]);
            }
            
            return response()->json($user, 201);
        } catch (\Throwable $th) {
            if (Str::contains($th->getMessage(), 'Duplicate entry') && Str::contains($th->getMessage(), 'users_username_unique')) {
                return response()->json(["errors" => ['email' => 'Usuario duplicado']], 409);
            }
            if (Str::contains($th->getMessage(), 'Duplicate entry') && Str::contains($th->getMessage(), 'users_email_unique')) {
                return response()->json(["errors" => ['email' => 'Correo electrónico duplicado']], 409);
            }
            return response()->json(["errors" => ['database' => 'Error en la base de datos: '.$th->getMessage()]], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE USERS");
        if ($perm == "All") return User::findOrFail($id);
        if ($perm == "Own") return User::where('owner', Auth::user()->owner ?? Auth::user()->id)->where('id', $id)->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStorePostRequest $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE USERS");
        if ($perm == "Own") {
            $user = User::where('owner', Auth::user()->owner ?? Auth::user()->id)->where('id', $id)->firstOrFail();
        }else if ($perm == "All") {
            $user = User::findOrFail($id);
        }
        $data = $request->only(['name', 'username', 'email', 'password', 'profile']);
        $user_data = User::where('id', Auth::user()->id)->with('profile_data')->first();
        $is_super_admin = $user_data->profile_data->name == "Super Admin";
        $data['owner'] = ($is_super_admin) ? null : Auth::user()->owner ?? Auth::user()->id;
        $data['profile'] = ($is_super_admin) ? env('ID_PROFILE_ADMIN', 2) : $data['profile'];

        // If profile is Super Admin or Admin
        if (in_array($data['profile'], [env('ID_PROFILE_SUPER_ADMIN', 1), env('ID_PROFILE_ADMIN', 2)]) && $perm == "Own") {
            return response()->json(["errors" => ['profile' => 'No tiene permisos para asignar este perfil']], 403);
        }
        try {
            $user->update($data);
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            if (Str::contains($th->getMessage(), 'Duplicate entry')) {
                return response()->json(["errors" => ['email' => 'Correo electrónico duplicado']], 409);
            }
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE USERS");
        if ($perm == "Own") {
            $user = User::where('owner', Auth::user()->owner ?? Auth::user()->id)->where('id', $id)->firstOrFail();
        }else if ($perm == "All") {
            $user = User::findOrFail($id);
        }
        $user->delete();
        return response()->json(null, 204);
    }
}
