<?php

namespace App\Http\Controllers;

use App\Http\Requests\FailureModeRequest;
use App\Models\FailureMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FailureModesController extends Controller
{

    /**
     * Get item by id and permission
     */
    function get_by_id_and_perms($id, $perm, $user_auth)
    {
        if (strtoupper($perm) == "OWN") {
            $failure_mode = FailureMode::where('id', $id)
                ->where('user_id', $user_auth->owner ?? $user_auth->id)
                ->firstOrFail();
        } else if (strtoupper($perm) == "ALL") {
            $failure_mode = FailureMode::findOrFail($id);
        }
        return $failure_mode;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE FAILURE MODES");
        $user_auth = Auth::user();
        if (strtoupper($perm) == "ALL") return FailureMode::all();
        if (strtoupper($perm) == "OWN") return FailureMode::where('user_id', $user_auth->owner ?? $user_auth->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FailureModeRequest $request)
    {
        try {
            $data = $request->only(['failure_mode']);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            $failure_mode = FailureMode::create($data);
            return response()->json($failure_mode, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE FAILURE MODES");
        $user_auth = Auth::user();
        return $this->get_by_id_and_perms($id, $perm, $user_auth);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, FailureModeRequest $request)
    {
        return response()->json($request->all(), 200);
        $perm = ProfileController::getPermissionByName("MANAGE FAILURE MODES");
        $user_auth = Auth::user();
        $failure_mode = $this->get_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only(['failure_mode']);

        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;

        try {
            $failure_mode->update($data);
            $failure_mode = $this->get_by_id_and_perms($id, $perm, $user_auth);
            return response()->json($failure_mode, 200);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE FAILURE MODES");
        $user_auth = Auth::user();
        $failure_mode = $this->get_by_id_and_perms($id, $perm, $user_auth);
        $failure_mode->delete();
        return response()->json(null, 204);
    }
}
