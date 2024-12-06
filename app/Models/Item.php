<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'nama',
        'kategori_id',
        'stok',
        'satuan_id',
    ];

    public function vendorItems()
    {
        return $this->hasMany(VendorItems::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }
}
