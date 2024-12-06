<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = [
        'nama', 'email', 'nomor', 'alamat',
    ];

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }

    public function vendorItems()
    {
        return $this->hasMany(VendorItems::class);
    }
}
