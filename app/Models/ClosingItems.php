<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClosingItems extends Model
{
    protected $table = 'closing_items';

    protected $fillable = [
        'closing_id', 'item_id','stok', 'jumlah', 'jumlah_berkurang',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function closing()
    {
        return $this->belongsTo(Closing::class);
    }
}
