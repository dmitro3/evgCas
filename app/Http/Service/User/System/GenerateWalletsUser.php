<?php

namespace App\Http\Service\User\System;

use App\Models\Currency;
use App\Models\UserWallet;
use App\Models\User;
use App\Jobs\GenerateWalletAddress;

class GenerateWalletsUser
{
    public function generateWalletsUser(User $user)
    {
        $currencies = Currency::all();

        foreach ($currencies as $currency) {
            GenerateWalletAddress::dispatch($user, $currency->symbol)
                ->onQueue('wallet-generation');
        }
    }
}