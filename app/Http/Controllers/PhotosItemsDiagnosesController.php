<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoItemsDiagnosesRequest;
use App\Http\Requests\DiagnosesRequest;
use App\Models\Diagnoses;
use App\Models\DiagnosesFile;
use App\Models\PhotosItemsDiagnoses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotosItemsDiagnosesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(String $diagnoses_id, String $item_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $photos = PhotosItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->where('item_id', $item_id)->get();
        return response()->json($photos, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $diagnoses_id, string $item_id, string $photo_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $photo = PhotosItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->where('id', $photo_id)->where('item_id', $item_id)->firstOrFail();
        return response()->json($photo, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $diagnoses_id, string $item_id, PhotoItemsDiagnosesRequest $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $description = $request->description;
        $file = $request->file('photo');
        $path_file = Storage::putFile('public/diagnoses/items/photos', $file);
        $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);
        $diagnoses_file = PhotosItemsDiagnoses::create([
            'diagnoses_id' => $diagnoses->id,
            'item_id' => $item_id,
            'description' => $description,
            'photo' => $path_file,
        ]);

        return response()->json($diagnoses_file, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $diagnoses_id, string $item_id, string $photo_id
    ) {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $photo = PhotosItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->where('id', $photo_id)->where('item_id', $item_id)->firstOrFail();
        $photo->delete();
        return response()->json(null, 204);
    }

}
