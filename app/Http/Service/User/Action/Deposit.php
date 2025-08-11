<?php

namespace App\Http\Service\User\Action;

use App\Models\User;
use App\Models\Deposit as ModelsDeposit;
use App\Models\Currency;

class Deposit
{
    public function deposit(User $user, $amount, $currency, $id_transaction)
    {
        $currency = Currency::where('symbol', $currency)->first();

        if(!$currency) {
            throw new \Exception('Currency not found');
        }

        $amount = $this->currencyCalculate($amount, $currency->symbol, 'USDTTRC20');

        $user->balance += $amount;
        $user->save();

        $deposit = ModelsDeposit::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'currency' => $currency->id,
            'status' => 'completed',
            'payment_id' => $id_transaction,
        ]);

        return $deposit;
    }

    private function currencyCalculate($amount, $fromCurrency, $toCurrency) : float
    {
        $fromRate = Currency::where('symbol', $fromCurrency)->first()->rate;
        $toRate = Currency::where('symbol', $toCurrency)->first()->rate;


        if (!$fromRate || !$toRate) {
            throw new \Exception('Currency rate not found');
        }

        return $amount * ((float)$fromRate / (float)$toRate);
    }
}