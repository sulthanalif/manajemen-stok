<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    protected $table = 'closings';

    protected $fillable = [
        'code',
        'user_id',
        'tanggal',
        'status',
    ];

    public function closingItems()
    {
        return $this->hasMany(ClosingItems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
