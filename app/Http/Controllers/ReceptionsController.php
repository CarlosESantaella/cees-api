<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Reception;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReceptionsExport;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ReceptionsPostRequest;

class ReceptionsController extends Controller
{
    /**
     * Get reception by id and permission
     */
    function get_reception_by_id_and_perms($id, $perm, $user_auth)
    {
        if ($perm == "Own") {
            $reception = Reception::where('id', $id)
                ->where('user_id', $user_auth->owner ?? $user_auth->id)
                ->firstOrFail();
        } else if ($perm == "All") {
            $reception = Reception::findOrFail($id);
        }
        return $reception;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        $query = Reception::query();


        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date)->endOfDay(); // Asegúrate de incluir la hora final del día
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($perm == "Own") {
            $query->where('user_id', $user_auth->owner ?? $user_auth->id);
        }

        $results = $query->get();
        return $results;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReceptionsPostRequest $request)
    {
        try {
            $data = $request->only([
                'equipment_type', 'brand', 'model', 'serie', 'capability', 'client_id',
                'comments', 'location', 'specific_location', 'type_of_job', 'equipment_owner',
                'customer_inventory'
            ]);
            $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;
            Client::where('id', $data['client_id'])->where('user_id', $data['user_id'])->firstOrFail();

            // Files
            $data['photos'] = [];
            $photos = $request->file('photos');
            if ($photos) {
                foreach ($photos as $index => $photo) {
                    if ($photo->isValid()) {
                        $path_file = Storage::putFile('public/receptions/photos', $photo);
                        $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);
                        $data['photos'][] = $path_file;
                    }
                }
            }
            $data['photos'] = implode(', ', $data['photos']);
            $data['state'] = 'Recibido';

            // Custom ID
            $user_auth = Auth::user();
            $configuration = Configuration::where('user_id', $user_auth->owner ?? $user_auth->id)->first();
            if (!$configuration) {
                return response()->json(["errors" => ['configuration' => 'Antes debes agregar un indice para los id de recepciones']], 500);
            }
            $data['custom_id'] = $configuration['index_reception_reference'];
            $configuration->update(['index_reception_reference' => $configuration['index_reception_reference']  + 1]);

            $reception = Reception::create($data);
            return response()->json($reception, 201);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th->getMessage()]], 500);
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
     * Get by serial or location.
     */
    public function find(Request $request)
    {
        $serial = $request->serial;
        $location = $request->location;
        $specific_location = $request->specific_location;
        $customer_inventory = $request->customer_inventory;

        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        $reception = false;
        if ($perm == "All") {
            $reception = Reception::where('serie', $serial)
                ->orWhere(function (Builder $query) use ($location, $specific_location) {
                    $query->where('location', $location)
                        ->where('specific_location', $specific_location);
                })
                ->first();
        }
        if ($perm == "Own") {
            $reception = Reception::where('serie', $serial)
                ->where('user_id', $user_auth->owner ?? $user_auth->id)
                ->orWhere(function (Builder $query) use ($location, $specific_location) {
                    $query->where('location', $location)
                        ->where('specific_location', $specific_location);
                })
                ->orWhere('customer_inventory', $customer_inventory)
                ->first();
        }
        $reception['exists'] = $reception ? true : false;
        return response()->json($reception, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        $reception = $this->get_reception_by_id_and_perms($id, $perm, $user_auth);

        $data = $request->only([
            'equipment_type', 'brand', 'model', 'serie', 'capability', 'client_id',
            'comments', 'location', 'specific_location', 'state', 'type_of_job', 'equipment_owner',
            'customer_inventory', 'created_at'
        ]);

        $data['user_id'] = (Auth::user()->profile != 1) ? Auth::user()->owner ?? Auth::user()->id : null;

        // Input Photos
        $photos_string = [];
        $photos_file = [];
        for ($i = 0; $i <= 20; $i++) {
            if (isset($request['photos_' . $i])) {
                if (gettype($request['photos_' . $i]) == 'string') {
                    $photos_string[] = $request['photos_' . $i];
                } else {
                    $photos_file[] = $request->file('photos_' . $i);
                }
            }
        }

        $data['photos'] = [];

        // DB Photos
        $db_photos = explode(', ', $reception['photos']);

        // Verify which photos was deleted
        foreach ($db_photos as $index => $db_photo) {
            if (!in_array($db_photo, $photos_string)) {
                Storage::delete(str_replace(env('SITE_URL') . '/public/storage/', 'public/', $db_photo));
            } else {
                $data['photos'][] = $db_photo;
            }
        }

        // Add new photos
        foreach ($photos_file as $index => $photo) {
            if ($photo->isValid()) {
                $path_file = Storage::putFile('public/receptions/photos', $photo);
                $path_file = str_replace('public/', env('SITE_URL') . '/public/storage/', $path_file);
                $data['photos'][] = $path_file;
            }
        }

        try {
            $data['photos'] = implode(', ', $data['photos']);
            $reception->update($data);
            $reception = $this->get_reception_by_id_and_perms($id, $perm, $user_auth);
            return response()->json($reception, 200);
        } catch (\Throwable $th) {
            return response()->json(["errors" => ['database' => $th]], 500);
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

    /**
     * Generate report
     */
    public function generateReport(Request $request, string $id)
    {

        $perm = ProfileController::getPermissionByName("MANAGE RECEPTIONS");
        $user_auth = Auth::user();
        $reception = false;
        if ($perm == "All") $reception = Reception::findOrFail($id);
        if ($perm == "Own") $reception = Reception::where('id', $id)
            ->where('user_id', $user_auth->owner ?? $user_auth->id)
            ->firstOrFail();
        $client = Client::where('id', $reception['client_id'])->firstOrFail();
        $pdf = Pdf::loadView('pdf.reception', ["reception" => $reception, "client" => $client, "pdf" => true]);
        $name_file = 'reception_' . $id . '.pdf';
        return $pdf->download($name_file);
    }

    public function exportExcel(Request $request)
    {
        $user_auth = Auth::user();
        $start_date = $request->start_date ?? false;
        $end_date = $request->end_date ?? false;
        $client_id = $request->client_id ?? false;
        $search = $request->search ?? false;
        return Excel::download(new ReceptionsExport($start_date, $end_date, $client_id, $search, $user_auth->id), 'recepciones.xlsx');
    }
}
