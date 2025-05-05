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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('domain_id')->index();
            $table->integer('worker_id')->index();
            $table->decimal('balance', 10, 2)->default(0);
            $table->integer('xp')->default(0);
            $table->boolean('banned')->default(0);
            $table->boolean('win_mode')->default(0);
            $table->boolean('fake_withdrawal')->default(0);
            $table->decimal('min_deposit', 10, 2)->default(10);
            $table->decimal('min_withdrawal', 10, 2)->default(10);
            $table->string('registered_ip')->nullable();
            $table->json('country_info')->nullable();
            $table->boolean('abuse_mode')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};