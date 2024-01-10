<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceptionsPostRequest;
use App\Models\Client;
use App\Models\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ReceptionsController extends Controller
{
    /**
     * Get reception by id and permission
     */
    function get_reception_by_id_and_perms($id, $perm, $user_auth) {
        if ($perm == "Own") {
            $reception = Reception::where('id', $id)
                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                            ->firstOrFail();
        }else if ($perm == "All") {
            $reception = Reception::findOrFail($id);
        }
        return $reception;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        if ($perm == "All") return Reception::all();
        if ($perm == "Own") return Reception::where('user_id', $user_auth->owner ?? $user_auth->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReceptionsPostRequest $request)
    {
        try {
            $data = $request->only(['equipment_type', 'brand', 'model', 'serie', 'capability', 'client_id', 'comments']);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            Client::where('id', $data['client_id'])->where('user_id', $data['user_id'])->firstOrFail();

            // Files
            $data['photos'] = [];
            $photos = $request->file('photos');
            foreach ($photos as $index => $photo) {
                if ($photo->isValid()) {
                    $path_file = Storage::putFile('public/receptions/photos', $photo);
                    $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);
                    $data['photos'][] = $path_file;
                }
            }
            $data['photos'] = implode(', ', $data['photos']);
            $data['state'] = 'Recibido';

            $reception = Reception::create($data);
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
        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        if ($perm == "All") return Reception::findOrFail($id);
        if ($perm == "Own") return Reception::where('id', $id)
                                            ->where('user_id', $user_auth->owner ?? $user_auth->id)
                                            ->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReceptionsPostRequest $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        $reception = $this->get_reception_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only(['equipment_type', 'brand', 'model', 'serie', 'capability', 'client_id', 'comments', 'state', 'photos']);
        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;

        // Input Photos
        $photos = $request->file('photos');

        return response()->json($photos, 200);

        $data['photos'] = [];

        // Old photos
        $old_photos = array_filter($photos, function ($photo) {
            if (gettype($photo) == 'string') {
                return $photo;
            }
        });

        // New photos
        $new_photos = array_filter($photos, function ($photo) {
            if ($photo->isValid()) {
                return $photo;
            }
        });

        // DB Photos
        $db_photos = explode(', ', $reception['photos']);

        // Verify which photos was deleted
        foreach ($db_photos as $index => $db_photo) {
            if (!in_array($db_photo, $old_photos)) {
                Storage::delete(str_replace(env('SITE_URL') . '/public/storage/', 'public/', $db_photo));
            }else {
                $data['photos'][] = $db_photo;
            }
        }

        // Add new photos
        foreach ($new_photos as $index => $photo) {
            if ($photo->isValid()) {
                $path_file = Storage::putFile('public/receptions/photos', $photo);
                $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);
                $data['photos'][] = $path_file;
            }
        }

        try {
            $reception->update($data);
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
        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        $user_id = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
        $reception = $this->get_reception_by_id_and_perms($id, $perm, $user_auth);
        Client::where('id', $reception['client_id'])->where('user_id', $user_id)->firstOrFail();
        $reception->delete();
        return response()->json(null, 204);
    }
}
