<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'color',
        'icon',
        'domain',
        'is_active',
    ];

}
