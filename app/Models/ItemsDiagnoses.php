<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsDiagnoses extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnoses_id',
        'item_id',
        'quantity',
    ];

}
