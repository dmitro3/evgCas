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
        Schema::table('crash_bets', function (Blueprint $table) {
            $table->decimal('auto_cash_out', 8, 2)->nullable()->after('multiplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crash_bets', function (Blueprint $table) {
            $table->dropColumn('auto_cash_out');
        });
    }
};
