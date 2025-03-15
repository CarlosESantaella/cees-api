<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'permissions',
        'user_id'
    ];

    protected $casts = [
        'permissions' => 'json',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'profile', 'id');
    }
}
