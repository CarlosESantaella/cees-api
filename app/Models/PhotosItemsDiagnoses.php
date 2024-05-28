<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotosItemsDiagnoses extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'diagnoses_id',
        'photo',
        'description'
    ];

}