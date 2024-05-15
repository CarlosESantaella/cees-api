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

}