<?php
namespace App\Rules;

use App\Models\Promo;
use App\Models\PromoActivation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PromoAbuseRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = auth()->user();

        if (! $user->abuse_mode) {
            $promo = Promo::where('promo', $value)->first();
            if (! $promo) {
                $fail('The promo is not found.');
                return;
            }
            $promoActivation = PromoActivation::where('user_id', $user->id)->where('promo_id', $promo->id)->first();
            if ($promoActivation) {
                $fail('The promo is already activated.');
                return;
            }
        }
    }
}
