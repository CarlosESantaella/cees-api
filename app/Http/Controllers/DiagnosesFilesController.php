<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosesFileRequest;
use App\Http\Requests\DiagnosesRequest;
use App\Models\Diagnoses;
use App\Models\DiagnosesFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiagnosesFilesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(String $diagnoses_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        return response()->json($diagnoses->files, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $diagnoses_id, string $file_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $diagnoses_file = $diagnoses->files->find($file_id);
        return response()->json($diagnoses_file, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadFile(string $diagnoses_id, DiagnosesFileRequest $request)
    {
        $filename = $request->filename;
        $file = $request->file('file');
        $type = $file->getMimeType();
        $path_file = Storage::putFile('public/diagnoses/files', $file);
        $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);

        $diagnoses_file = DiagnosesFile::create([
            'filename' => $filename,
            'file' => $path_file,
            'type' => $type,
            'diagnoses_id' => $diagnoses_id
        ]);

        return response()->json($diagnoses_file, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $diagnoses_id, string $file_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $diagnoses_file = $diagnoses->files->find($file_id);
        $diagnoses_file->delete();
        return response()->json(null, 204);
    }

}
