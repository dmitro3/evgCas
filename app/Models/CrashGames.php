<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrashGames extends Model
{
    protected $fillable = ['crash_point', 'multiplier', 'status'];

    protected $casts = [
        'crash_point' => 'float',
        'multiplier' => 'float',
    ];
}
