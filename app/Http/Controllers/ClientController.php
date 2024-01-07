<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientPostRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE CLIENTS");
        $user_auth = Auth::user();
        if ($perm == "All") return Client::all();
        if ($perm == "Own") return Client::where('user_id', $user_auth->owner ?? $user_auth->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientPostRequest $request)
    {
        try {
            $data = $request->only(['full_name', 'address', 'nit', 'contact', 'cellphone', 'identification', 'city', 'cell', 'email', 'comments']);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            $client = Client::create($data);
            return response()->json($client, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE CLIENTS");
        $user_auth = Auth::user();
        if ($perm == "All") return Client::findOrFail($id);
        if ($perm == "Own") return Client::where('id', $id)
                                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                                            ->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientPostRequest $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE CLIENTS");
        $user_auth = Auth::user();
        if ($perm == "Own") {
            $client = Client::where('id', $id)
                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                            ->firstOrFail();
        }else if ($perm == "All") {
            $client = Client::findOrFail($id);
        }
        $data = $request->only(['full_name', 'address', 'nit', 'contact', 'cellphone', 'identification', 'city', 'cell', 'email', 'comments']);
        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
        try {
            $client->update($data);
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
        $perm = ProfileController::getPermissionByName("MANAGE USERS");
        $user_auth = Auth::user();
        if ($perm == "Own") {
            $client = Client::where('id', $id)
                            ->where('user_id', $user_auth->owner ?? $user_auth->id )
                            ->firstOrFail();
        }else if ($perm == "All") {
            $client = Client::findOrFail($id);
        }
        $client->delete();
        return response()->json(null, 204);
    }
}
