<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plinko_positions', function (Blueprint $table) {
            $table->id();
            $table->decimal('position_x', 8, 2);
            $table->integer('bucket_index');
            $table->decimal('multiplier', 8, 2);
            $table->integer('rows');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plinko_positions');
    }
};
