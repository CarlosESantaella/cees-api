<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_path',
        'index_reception',
        'index_reception_reference',
        'currency',
        'user_id'
    ];

}
