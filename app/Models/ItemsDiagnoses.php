<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemsDiagnoses extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnoses_id',
        'item_id',
        'quantity',
    ];


    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

}
