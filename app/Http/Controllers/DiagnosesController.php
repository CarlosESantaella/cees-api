<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosesFileRequest;
use App\Http\Requests\DiagnosesRequest;
use App\Models\Diagnoses;
use App\Models\DiagnosesFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiagnosesController extends Controller
{

    /**
     * Get item by id and permission
     */
    function get_by_id_and_perms($id, $perm, $user_auth) {
        if ($perm == "Own") {
            $diagnoses = Diagnoses::where('id', $id)
                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                            ->with(['files', 'failure_modes'])
                            ->firstOrFail();
        }else if ($perm == "All") {
            $diagnoses = Diagnoses::findOrFail($id);
        }
        return $diagnoses;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        if ($perm == "All") return Diagnoses::with('files')->with('failure_modes.failureMode')->all();
        if ($perm == "Own") return Diagnoses::where('user_id', $user_auth->owner ?? $user_auth->id)->with('files')->with('failure_modes.failureMode')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiagnosesRequest $request)
    {
        try {
            $data = $request->only(['status', 'description', 'reception_id']);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            $diagnoses = Diagnoses::create($data);
            return response()->json($diagnoses, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        return $this->get_by_id_and_perms($id, $perm, $user_auth);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiagnosesRequest $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses = $this->get_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only(['status', 'description', 'reception_id']);

        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;

        try {
            $diagnoses->update($data);
            $diagnoses = $this->get_by_id_and_perms($id, $perm, $user_auth);
            return response()->json($diagnoses, 200);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses = $this->get_by_id_and_perms($id, $perm, $user_auth);
        $diagnoses->delete();
        return response()->json(null, 204);
    }

    /**
     * Change status diagnoses.
     */
    public function updateStatus(string $id, bool $status)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses = $this->get_by_id_and_perms($id, $perm, $user_auth);
        $diagnoses->status = $status;
        $diagnoses->save();
        return response()->json(null, 204);
    }

}
