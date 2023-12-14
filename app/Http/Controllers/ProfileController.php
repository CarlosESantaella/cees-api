<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStorePostRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public $all_permissions = [
        'MANAGE USERS' => "None",
        'MANAGE PROFILES' => "None",
        'MANAGE REQUEST' => "None",
        "MANAGE SERVICES" => "None",
        "MANAGE DIAGNOSES AND QUOTES" => "None",
        "MANAGE INVENTORY" => "None",
        "MANAGE ORDERS" => "None",
        "MANAGE CONFIGURATION" => "None",
    ];

    public $restricted_permissions = [
        'MANAGE REQUEST' => "None",
        "MANAGE SERVICES" => "None",
        "MANAGE DIAGNOSES AND QUOTES" => "None",
        "MANAGE INVENTORY" => "None",
        "MANAGE ORDERS" => "None",
        "MANAGE CONFIGURATION" => "None",
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Profile::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileStorePostRequest $request)
    {
        try {
            $data = $request->all();
            $data['permissions'] = json_decode($data['permissions']);
            $profile = Profile::create($data);
            return response()->json(["id" => $profile->id], 201);
        } catch (\Throwable $th) {
            if (Str::contains($th->getMessage(), 'Duplicate entry')) {
                return response()->json(["errors" => ['email' => 'Nombre duplicado']], 409);
            }
            return response()->json(["errors" => ['database' => $th->getMessage()]], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Profile::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileStorePostRequest $request, string $id)
    {
        try {
            $profile = Profile::findOrFail($id);
            $profile->update($request->all());
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
        $profile = Profile::find($id);
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
        $user = Auth::user();
        $profile = Profile::findOrFail($user->profile);
        if ($profile->name == "Super Admin") return $this->all_permissions;
        return $this->restricted_permissions;
    }

    /**
     * Get permission by name.
     */
    public static function getPermissionByName(string $name)
    {
        // TODO: Ver porque no trae todo bien con ->with
        $user = Auth::user();
        $profile = Profile::findOrFail($user->profile);
        try {
            return $profile->permissions[$name];
        } catch (\Throwable $th) {
            "None";
        }
    }
}
