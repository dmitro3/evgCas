<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('bet_amount', 10, 2);
            $table->integer('mines_per_row')->default(2);
            $table->integer('current_level')->default(0);
            $table->json('game_map');
            $table->json('revealed_cells')->default('[]');
            $table->enum('status', ['active', 'won', 'lost', 'cashed_out'])->default('active');
            $table->decimal('winnings', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('towers');
    }
};