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
        Schema::create('withdraw_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('currency_id')->index();
            $table->enum('type', ['crypto', 'fiat']);
            $table->string('address');
            $table->string('comment')->nullable();
            $table->decimal('amount', 15, 8);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_users');
    }
};
