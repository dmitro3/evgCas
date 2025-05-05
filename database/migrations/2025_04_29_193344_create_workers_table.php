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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique()->index();
            $table->string('password');
            $table->string('telegram_id')->unique();
            $table->boolean('is_admin')->default(false);
            $table->integer('percent')->default(75);
            $table->integer('daily_bonus')->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->boolean('is_banned')->default(false);
            $table->string('google2fa_secret')->nullable();
            $table->boolean('google2fa_enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
