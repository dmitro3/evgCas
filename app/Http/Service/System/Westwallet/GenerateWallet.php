<?php

namespace App\Http\Service\System\Westwallet;

use WestWallet\WestWallet\Client;
use WestWallet\WestWallet\CurrencyNotFoundException;

class GenerateWallet
{
    public function generateWallet($currency)
    {
        $client = new Client(env("WESTWALLET_PUBLIC_KEY"), env("WESTWALLET_SECRET_KEY"));

        try {
            $address = $client->generateAddress($currency);
            return $address['address'];
        } catch(CurrencyNotFoundException $e) {
            return null;
        }
    }
}
