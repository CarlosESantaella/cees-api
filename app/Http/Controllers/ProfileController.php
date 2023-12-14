<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStorePostRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
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
}
