<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStorePostRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public $all_permissions = [
        'MANAGE PROFILES' => "NONE", //página de roles
        'MANAGE USERS' => "NONE", //página de usuarios (este permiso solo lo pide el super admin)
        "MANAGE CLIENTS" => "NONE",  //página de clientes
        "MANAGE RECEPTIONS" => "NONE", //página de recepciONEs
        "MANAGE ITEMS" => "NONE", //página de items
        "MANAGE RATES" => "NONE",  //página de tarifas
        "MANAGE FAILURE MODES" => "NONE", //página de modos de falla
        "MANAGE DIAGNOSES" => "NONE", //página de diagnósticos y cotizaciONEs
        "MANAGE CONFIGURATIONS" => "NONE", //página de configuraciONEs
        'MANAGE REQUEST' => "NONE", // no se usa de momento (si en próximos módulos despues del 5 no se usa, eliminarlo)
        "MANAGE SERVICES" => "NONE", // no se usa de momento (si en próximos módulos despues del 5 no se usa, eliminarlo)
        "MANAGE INVENTORY" => "NONE", // no se usa de momento (si en próximos módulos despues del 5 no se usa, eliminarlo)
        "MANAGE ORDERS" => "NONE", // no se usa de momento (si en próximos módulos despues del 5 no se usa, eliminarlo)
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_auth = Auth::user();
        return Profile::where('user_id', $user_auth->owner ?? $user_auth->id)->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileStorePostRequest $request)
    {
        try {
            $data = $request->only(['name', 'permissions']);
            $data['permissions'] = json_decode($data['permissions']??"{}");
            $data['user_id'] = Auth::user()->owner ?? Auth::user()->id;
            $profile = Profile::create($data);
            return response()->json($profile, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th->getMessage()]], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Profile::where('user_id', Auth::user()->owner ?? Auth::user()->id)->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileStorePostRequest $request, string $id)
    {
        try {
            $profile = Profile::where('user_id', Auth::user()->owner ?? Auth::user()->id)->findOrFail($id);
            $data = $request->only(['name', 'permissions']);
            if($request->has('name')){
                $data['name'] = $data['name'];
            }
            if($request->has('permissions')){
                $data['permissions'] = json_decode($data['permissions']);
            }
            $data['user_id'] = Auth::user()->owner ?? Auth::user()->id;
            $profile->update($data);
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = Profile::where('user_id', Auth::user()->owner ?? Auth::user()->id)->findOrFail($id);
        if (!$profile) {
            return response()->json(["errors" => ['id' => "Perfil con el id $id no existe"]], 400);
        }
        $profile->delete();
        return response()->json(null, 204);
    }

    /**
     * Get permissions.
     */
    public function getPermissions()
    {
        return $this->all_permissions;
    }

    /**
     * Get permission by name.
     */
    public static function getPermissionByName(string $name)
    {
        $user = Auth::user();
        try {
            $user_data = User::where('id', $user->id)->with('profile_data')->first();
            return strtoupper($user_data->profile_data->permissions[$name]);
        } catch (\Throwable $th) {
            "NONE";
        }
    }
}
