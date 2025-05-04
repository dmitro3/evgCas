<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'network',
        'min_deposit',
    ];

    public function userWallets()
    {
        return $this->hasMany(UserWallet::class);
    }
}
