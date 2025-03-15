<?php

namespace App\Http\Controllers;

use App\Models\ItemsRates;
use Illuminate\Http\Request;
use App\Models\ItemsDiagnoses;
use Illuminate\Support\Facades\Auth;

class RatesItemsController extends Controller
{
    public function index(string $rate_id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RATES");
        $rates_controller = new RatesController;
        $user_auth = Auth::user();
        $rates = $rates_controller->get_rate_by_id_and_perms($rate_id, $perm, $user_auth);
        $ratesItems = ItemsRates::where('rate_id', $rates->id)->with('item')->get();


        return response()->json($ratesItems, 200);
    }

    /**
     * Update the resource.
     */
    public function update(String $rate_id, Request $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RATES");
        $user_auth = Auth::user();
        $rates_controller = new RatesController;
        $rate = $rates_controller->get_rate_by_id_and_perms($rate_id, $perm, $user_auth);
        $data = $request->only(['items']);
        ItemsRates::where('rate_id', $rate->id)->delete();
        foreach ($data['items'] as $item) {
            ItemsRates::create([
                "item_id" => $item['item_id'],
                "rate_id" => $rate->id,
                "quantity" => $item['quantity'],
            ]);
        }
        $items = ItemsRates::where('rate_id', $rate->id)->get();
        return response()->json($items, 200);
    }
}
