<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('bet_amount', 10, 2);
            $table->decimal('target_number', 5, 2);
            $table->decimal('roll_result', 5, 2)->nullable();
            $table->decimal('multiplier', 8, 2);
            $table->enum('status', ['pending', 'won', 'lost'])->default('pending');
            $table->decimal('winnings', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dices');
    }
};