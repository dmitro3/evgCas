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
        Schema::create('worker_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('worker_id')->index();
            $table->boolean('win_mode')->default(false);
            $table->boolean('abuse_promo')->default(false);
            $table->boolean('verification_mode')->default(false);
            $table->boolean('fake_withdraw')->default(false);
            $table->boolean('multy_account')->default(false);
            $table->decimal('minimal_deposit', 10, 2)->default(0);
            $table->decimal('minimal_withdraw', 10, 2)->default(0);
            $table->string('keyword_email')->nullable();
            $table->json('payment_methods')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_settings');
    }
};
