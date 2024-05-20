<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnoses extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'reception_id',
        'user_id'
    ];

    public function files()
    {
        return $this->hasMany(DiagnosesFile::class);
    }

    public function failure_modes()
    {
        return $this->hasMany(FailureModesDiagnoses::class);
    }
 
}