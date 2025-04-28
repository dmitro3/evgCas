<?php
namespace App\Http\Service\User\Action;

use App\Models\Promo;
use App\Models\PromoActivation;
use Illuminate\Support\Facades\Log;

class ActivePromo
{
    public function activePromo($promo): bool
    {
        try {
            $user = auth()->user();
            if (! $user) {
                throw new \Exception('User not found');
            }
            $promo = Promo::where('promo', $promo)->first();

            $promoActivation           = new PromoActivation();
            $promoActivation->promo_id = $promo->id;
            $promoActivation->user_id  = $user->id;
            $promoActivation->save();

            $user->balance += $promo->amount_bonus;
            $user->save();
            return true;
        } catch (\Exception $e) {
            Log::error("Error activating promo user: " . $e->getMessage());
            return false;
        }
    }
}
