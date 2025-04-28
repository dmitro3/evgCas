<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'promo',
        'user_id',
        'amount_bonus',
        'win_mode',


    ];
}