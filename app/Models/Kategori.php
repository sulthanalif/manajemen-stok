<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
