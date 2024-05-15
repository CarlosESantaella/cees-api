<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailureMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'failure_mode',
        'user_id'
    ];

}