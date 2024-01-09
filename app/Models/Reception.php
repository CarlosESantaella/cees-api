<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_type',
        'brand',
        'model',
        'serie',
        'capability',
        'client_id',
        'user_id',
        'photos'
    ];

}
