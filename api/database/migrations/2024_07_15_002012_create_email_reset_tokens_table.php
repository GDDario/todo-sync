<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_reset_tokens', function (Blueprint $table) {
            $table->bigInteger('user_id')->primary();
            $table->string('token', 255);
            $table->boolean('opened')->default(false);
            $table->dateTime('created_at');

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_reset_tokens');
    }
};
