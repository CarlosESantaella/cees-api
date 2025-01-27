<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'cellphone',
        'address',
        'nit',
        'contact',
        'user_id',
        'identification',
        'cell',
        'city',
        'email',
        'comments'
    ];


    public function receptions()
    {
        return $this->hasMany(Reception::class);
    }

}
