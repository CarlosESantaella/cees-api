<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosesFileRequest;
use App\Http\Requests\DiagnosesRequest;
use App\Models\Diagnoses;
use App\Models\DiagnosesFile;
use App\Models\ItemsDiagnoses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DiagnosesItemsController extends Controller
{

    /**
     * Store the resource.
     */
    public function store(String $diagnoses_id, Request $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $data = $request->only(['item_id', 'quantity']);
        $item_diagnoses_found = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->where('item_id', $data['item_id'])->first();
        if ($item_diagnoses_found) {
            return response()->json(["errors" => ['item_id' => 'El item ya se encuentra en la lista']], 422);
        }
        ItemsDiagnoses::create([
            'diagnoses_id' => $diagnoses->id,
            'item_id' => $data['item_id'],
            'quantity' => $data['quantity']
        ]);
        $items = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->get();
        return response()->json($items, 200);
    }

    /**
     * Update the resource.
     */
    public function update(String $diagnoses_id, String $item_id, Request $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $data = $request->only(['quantity']);
        $item_diagnoses_found = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->where('item_id', $item_id)->first();
        if (!$item_diagnoses_found) {
            return response()->json(["errors" => ['item_id' => 'El item no se encuentra en la lista']], 422);
        }
        $item_diagnoses_found->update($data);
        $items = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->get();
        return response()->json($items, 200);
    }

    /**
     * Remove the resource.
     */
    public function destroy(String $diagnoses_id, String $item_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES AND QUOTES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $item_diagnoses_found = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->where('item_id', $item_id)->first();
        if (!$item_diagnoses_found) {
            return response()->json(["errors" => ['item_id' => 'El item no se encuentra en la lista']], 422);
        }
        $item_diagnoses_found->delete();
        $items = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->get();
        return response()->json($items, 200);
    }

}
