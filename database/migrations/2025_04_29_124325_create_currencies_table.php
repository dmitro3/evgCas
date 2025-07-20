<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol')->unique()->index();
            $table->string('network')->nullable();
            $table->decimal('min_deposit', 15, 8)->default(0);
            $table->string('rate')->nullable();
            $table->timestamps();
        });
        DB::table('currencies')->insert([
            ['name' => 'Bitcoin', 'symbol' => 'BTC', 'network' => null, 'min_deposit' => 0.0005],
            ['name' => 'Ethereum', 'symbol' => 'ETH', 'network' => null, 'min_deposit' => 0.005],
            ['name' => 'Solana', 'symbol' => 'SOL', 'network' => null, 'min_deposit' => 0.1],
            ['name' => 'TRX', 'symbol' => 'TRX', 'network' => 'TRX', 'min_deposit' => 20],
            ['name' => 'Dogecoin', 'symbol' => 'DOGE', 'network' => 'DOGE', 'min_deposit' => 25],
            ['name' => 'USDT TRC20', 'symbol' => 'USDTTRC20', 'network' => 'TRC20', 'min_deposit' => 10],
            ['name' => 'USDT ERC20', 'symbol' => 'USDTERC20', 'network' => 'ERC20', 'min_deposit' => 50],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
