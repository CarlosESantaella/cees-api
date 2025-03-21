<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Diagnoses;
use Illuminate\Http\Request;
use App\Models\DiagnosesFile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiagnosesRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DiagnosesFileRequest;

class DiagnosesController extends Controller
{

    /**
     * Get item by id and permission
     */
    function get_by_id_and_perms($id, $perm, $user_auth)
    {
        if (strtoupper($perm) == "OWN") {
            $diagnoses = Diagnoses::where('id', $id)
                ->where('user_id', $user_auth->owner ?? $user_auth->id)
                ->with(['files', 'failure_modes'])
                ->firstOrFail();
        } else if (strtoupper($perm) == "ALL") {
            $diagnoses = Diagnoses::findOrFail($id);
        }
        return $diagnoses;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $user_auth = Auth::user();
        if (strtoupper($perm) == "ALL") return Diagnoses::with('files')->with('failure_modes.failureMode')->all();
        if (strtoupper($perm) == "OWN") return Diagnoses::where('user_id', $user_auth->owner ?? $user_auth->id)->with('files')->with('failure_modes.failureMode')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiagnosesRequest $request)
    {
        try {
            $data = $request->only(['status', 'description', 'reception_id', 'observations']);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            Diagnoses::where('reception_id', $data['reception_id'])->delete();
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
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $user_auth = Auth::user();
        return $this->get_by_id_and_perms($id, $perm, $user_auth);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiagnosesRequest $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $user_auth = Auth::user();
        $diagnoses = $this->get_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only(['status', 'description', 'reception_id', 'observations']);

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
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
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
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $user_auth = Auth::user();
        $diagnoses = $this->get_by_id_and_perms($id, $perm, $user_auth);
        $diagnoses->status = $status;
        $diagnoses->initial_date = Carbon::now();
        $diagnoses->save();
        return response()->json($diagnoses->refresh(), Response::HTTP_OK);
    }
}
