<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailureModesDiagnoses extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnoses_id',
        'failure_modes_id'
    ];


    public function failureMode(){
        return $this->belongsTo(FailureMode::class, 'failure_modes_id', 'id');
    }

}
