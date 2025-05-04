<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawUser extends Model
{
    protected $fillable = [
        'user_id',
        'currency_id',
        'type',
        'address',
        'comment',
        'amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
