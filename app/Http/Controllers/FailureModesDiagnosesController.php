<?php

namespace App\Http\Controllers;

use App\Http\Requests\FailureModeDiagnosesRequest;
use App\Models\FailureModesDiagnoses;
use Illuminate\Support\Facades\Auth;

class FailureModesDiagnosesController extends Controller
{

    /**
     * Ipdate a resource.
     */
    public function update(String $diagnoses_id, FailureModeDiagnosesRequest $request)
    {
        $perm = ProfileController::getPermissionByName("MANAGE DIAGNOSES");
        $user_auth = Auth::user();
        $diagnoses_controller = new DiagnosesController;
        $diagnoses = $diagnoses_controller->get_by_id_and_perms($diagnoses_id, $perm, $user_auth);

        FailureModesDiagnoses::where('diagnoses_id', $diagnoses->id)->delete();

        $this->create_failure_modes_diagnoses($diagnoses->id, $request->failure_modes);

        $failure_modes_diagnoses = FailureModesDiagnoses::where('diagnoses_id', $diagnoses->id)->with('failureMode')->get();


        return response()->json($failure_modes_diagnoses, 200);
    }

    private function create_failure_modes_diagnoses($diagnoses_id, $failure_modes)
    {
        foreach ($failure_modes as $failure_mode) {
            FailureModesDiagnoses::create([
                'diagnoses_id' => $diagnoses_id,
                'failure_modes_id' => $failure_mode
            ]);
        }
    }
}
