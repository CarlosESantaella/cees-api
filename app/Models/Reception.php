<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_id',
        'equipment_type',
        'brand',
        'model',
        'serie',
        'capability',
        'client_id',
        'user_id',
        'comments',
        'state',
        'photos',
        'location',
        'specific_location',
        'type_of_job',
        'equipment_owner',
        'customer_inventory'
    ];

}
