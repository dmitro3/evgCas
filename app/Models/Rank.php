<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['name', 'xp_min', 'xp_max', 'type', 'level'];
}
