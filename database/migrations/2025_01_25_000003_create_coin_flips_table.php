<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coin_flips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('bet_amount', 10, 2);
            $table->enum('player_choice', ['heads', 'tails']);
            $table->enum('result', ['heads', 'tails']);
            $table->decimal('multiplier', 8, 2)->default(0);
            $table->integer('series_count')->default(1);
            $table->enum('status', ['won', 'lost'])->default('lost');
            $table->decimal('winnings', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coin_flips');
    }
};