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
        Schema::create('application_preferences', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->bigInteger('user_id');
            $table->bigInteger('theme_id');
            $table->bigInteger('font_factor_id');
            $table->bigInteger('language_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('font_factor_id')->references('id')->on('font_factors');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('theme_id')->references('id')->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application');
    }
};
