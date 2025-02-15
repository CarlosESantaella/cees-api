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

    public function index(string $diagnostic_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $diagnoses_controller = new DiagnosesController;
        $user_auth = Auth::user();
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnostic_id, $perm, $user_auth);
        $diagnosticItems = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->with('item')->get();



        return response()->json($diagnosticItems, 200);
    }

    /**
     * Update the resource.
     */
    public function update(String $diagnoses_id, Request $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);
        $data = $request->only(['items']);
        ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->delete();
        foreach ($data['items'] as $item) {
            ItemsDiagnoses::create([
                "item_id" => $item['item_id'],
                "diagnoses_id" => $diagnoses->id,
                "quantity" => $item['quantity'],
            ]);
        }
        $items = ItemsDiagnoses::where('diagnoses_id', $diagnoses->id)->get();
        return response()->json($items, 200);
    }
}
