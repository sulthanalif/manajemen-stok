<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'code',
        'user_id',
        'tanggal',
        'status',
        'waiting',
        'total_harga',
        'bank',
        'is_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }
}
