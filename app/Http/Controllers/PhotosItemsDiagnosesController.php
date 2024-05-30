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
    public function index(String $diagnoses_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $photos = PhotosItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->get();
        return response()->json($photos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $diagnoses_id, Request $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);

        PhotosItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->delete();

        // Files
        $data = $request->only(['items']);
        $items = $data['items'];

        $photos = $request->file('photos');
        if ($photos) {
            foreach ($photos as $index => $photo) {
                if ($photo->isValid()) {
                    $path_file = Storage::putFile('public/diagnoses/items/photo', $photo);
                    $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);
                    PhotosItemsDiagnoses::create([
                        'diagnoses_id' => $diagnoses->id,
                        'item_id' => $items[$index],
                        'description' => '',
                        'photo' => $path_file,
                    ]);
                }
            }
        }

        $photos_items = PhotosItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->get();
        return response()->json($photos_items, 201);
    }

}
