<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosesFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'file',
        'type',
        'diagnoses_id'
    ];

}