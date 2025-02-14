<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_auth = Auth::user();
        return Configuration::where('user_id', $user_auth->owner ?? $user_auth->id)->first();
    }

    /**
     * Get configuration by owner and permission
     */
    function get_configuration_by_owner($user_auth)
    {
        $configuration = Configuration::where(
            'user_id',
            $user_auth->owner ?? $user_auth->id
        )->first();
        return $configuration;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $user_auth = Auth::user();
            $configuration = $this->get_configuration_by_owner($user_auth);

            $data = $request->only([
                'index_reception', 'currency'
            ]);
            $index_reception = 0;
            $currency = "";
            if ($configuration) {
                $index_reception = $configuration->index_reception;
                $currency = $configuration->currency;
            }
            $data['index_reception_reference'] = $data['index_reception'] ?? $index_reception;
            $data['currency'] = $data['currency'] ?? $currency;
            // $data['user_id'] = Auth::user()->owner ?? Auth::user()->id;

            if ($request->has('logo')) {
                $logo = $request->file('logo');
                //path validate
                $dir_path = 'public/configurations/logos';
                if (!Storage::exists($dir_path)) {
                    Storage::makeDirectory($dir_path);
                }
                if($configuration->logo_path){
                    Storage::delete('public/configurations/logos/'.pathinfo($configuration->logo_path, PATHINFO_BASENAME));
                }
                //save logo
                $path_file = Storage::putFile($dir_path, $logo);
                $path_file = str_replace('public/', env('SITE_URL') . '/storage/', $path_file);
                $data['logo_path'] = $path_file;
            }
        } catch (\Exception $e) {
            return response()->json(["errors" => ['database' => $e->getMessage() . '-' . $e->getLine()]], 500);
        }

        try {
            if ($configuration) {
                $configuration->update($data);
            } else {
                $configuration = Configuration::create($data);
            }

            return response()->json($configuration, 200);
        } catch (\Exception $e) {
            return response()->json(["errors" => ['database' => $e->getMessage()]], 500);
        }
    }
}
