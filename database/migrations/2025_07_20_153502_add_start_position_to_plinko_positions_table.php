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
        Schema::table('plinko_positions', function (Blueprint $table) {
            $table->decimal('start_position_x', 8, 2)->after('position_x')->comment('Начальная позиция мяча по X');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plinko_positions', function (Blueprint $table) {
            $table->dropColumn('start_position_x');
        });
    }
};
