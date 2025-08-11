<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'status',
        'payment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currencies()
    {
        return $this->belongsTo(Currency::class, 'currency', 'id');
    }


}
