<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoActivation extends Model
{
    protected $fillable = [
        'promo_id',
        'user_id',
    ];

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }


}