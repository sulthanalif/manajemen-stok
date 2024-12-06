<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $fillable = [
        'nama',
        'simbol',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
