<?php

namespace App\Http\Service\System\Promo;

use App\Models\Promo;

class ExistPromo
{
    public function existPromo($promo)
    {
        $promo = Promo::where('promo', $promo)->first();
        if ($promo) {
            return true;
        }
        return false;
    }
}