<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlinkoPosition extends Model
{
    protected $fillable = [
        'position_x',
        'bucket_index',
        'multiplier',
        'rows'
    ];
}
