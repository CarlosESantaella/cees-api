<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{

    /**
     * Get item by id and permission
     */
    function get_item_by_id_and_perms($id, $perm, $user_auth)
    {
        if (strtoupper($perm) == "OWN") {
            $item = Item::where('id', $id)
                ->where('user_id', $user_auth->owner ?? $user_auth->id)
                ->firstOrFail();
        } else if (strtoupper($perm) == "ALL") {
            $item = Item::findOrFail($id);
        }
        return $item;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perm = ProfileController::getPermissionByName("MANAGE ITEMS");
        $user_auth = Auth::user();
        if (strtoupper($perm) == "ALL") return Item::all();
        if (strtoupper($perm) == "OWN") return Item::where('user_id', $user_auth->owner ?? $user_auth->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only([
                'description',
                'unit_of_measurement',
                'gross_cost',
                'indirect_cost',
                'utility',
                'total_cost',
                'initial_description',
                'final_description',
                'rate_id'
            ]);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            $item = Item::create($data);
            return response()->json($item, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => 'Error en la base de datos']], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE ITEMS");
        $user_auth = Auth::user();
        if (strtoupper($perm) == "ALL") return Item::findOrFail($id);
        if (strtoupper($perm) == "OWN") return Item::where('id', $id)
            ->where('user_id', $user_auth->owner ?? $user_auth->id)
            ->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE ITEMS");
        $user_auth = Auth::user();
        $item = $this->get_item_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only([
            'description',
            'unit_of_measurement',
            'gross_cost',
            'indirect_cost',
            'utility',
            'total_cost',
            'initial_description',
            'final_description',
            'rate_id'
        ]);

        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;

        try {
            $item->update($data);
            $item = $this->get_item_by_id_and_perms($id, $perm, $user_auth);
            return response()->json($item, 200);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th]], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE ITEMS");
        $user_auth = Auth::user();
        $item = $this->get_item_by_id_and_perms($id, $perm, $user_auth);
        $item->delete();
        return response()->json(null, 204);
    }
}
