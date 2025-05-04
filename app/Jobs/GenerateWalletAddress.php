<?php

namespace App\Jobs;

use App\Models\Currency;
use App\Models\UserWallet;
use App\Models\User;
use App\Http\Service\System\Westwallet\GenerateWallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateWalletAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $currencySymbol;

    public function __construct(User $user, string $currencySymbol)
    {
        $this->user = $user;
        $this->currencySymbol = $currencySymbol;
    }

    public function handle()
    {
        $generateWallet = new GenerateWallet();
        $address = $generateWallet->generateWallet($this->currencySymbol);

        if ($address !== null && $address !== false) {
            $this->user->wallets()->create([
                'currency' => $this->currencySymbol,
                'address' => $address
            ]);
            Log::info('Wallet address generated successfully', [
                'user_id' => $this->user->id,
                'currency' => $this->currencySymbol
            ]);
        } else {
            Log::error('Failed to generate wallet address', [
                'user_id' => $this->user->id,
                'currency' => $this->currencySymbol
            ]);

            if ($this->attempts() < 3) {
                $this->release(60 * $this->attempts());
            }
        }
    }
}