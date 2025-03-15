<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    use HasFactory;

    protected $fillable = [
        'gross_cost',
        'indirect_cost',
        'utility',
        'total_cost',
        'clients',
        'user_id'
    ];

}
