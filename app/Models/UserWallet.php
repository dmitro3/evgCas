<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $fillable = [
        'user_id',
        'currency',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
