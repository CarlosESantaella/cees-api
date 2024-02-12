<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'unit_of_measurement',
        'gross_cost',
        'indirect_cost',
        'utility',
        'total_cost',
        'initial_description',
        'final_description',
        'user_id',
        'rate_id'
    ];

}