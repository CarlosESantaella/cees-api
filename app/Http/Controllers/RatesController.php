<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Configuration;
use App\Models\Rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class RatesController extends Controller
{

    /**
     * Get rate by id and permission
     */
    function get_rate_by_id_and_perms($id, $perm, $user_auth) {
        if ($perm == "Own") {
            $rate = Rates::where('id', $id)
                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                            ->firstOrFail();
        }else if ($perm == "All") {
            $rate = Rates::findOrFail($id);
        }
        return $rate;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE RATES");
        $user_auth = Auth::user();
        if ($perm == "All") return Rates::all();
        if ($perm == "Own") return Rates::where('user_id', $user_auth->owner ?? $user_auth->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only(['clients']);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            $reception = Rates::create($data);
            return response()->json($reception, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RATES");
        $user_auth = Auth::user();
        if ($perm == "All") return Rates::findOrFail($id);
        if ($perm == "Own") return Rates::where('id', $id)
                                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                                            ->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RATES");
        $user_auth = Auth::user();
        $rate = $this->get_rate_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only(['clients']);

        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;

        try {
            $rate->update($data);
            $rate = $this->get_rate_by_id_and_perms($id, $perm, $user_auth);
            return response()->json($rate, 200);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RATES");
        $user_auth = Auth::user();
        $rate = $this->get_rate_by_id_and_perms($id, $perm, $user_auth);
        $rate->delete();
        return response()->json(null, 204);
    }
}
