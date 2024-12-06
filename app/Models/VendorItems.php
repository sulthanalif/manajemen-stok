<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorItems extends Model
{
    protected $table = 'vendor_items';

    protected $fillable = [
        'vendor_id', 'item_id', 'harga',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
