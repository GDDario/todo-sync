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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('primary', 9);
            $table->string('primary_variant', 9);
            $table->string('secondary', 9);
            $table->string('secondary_variant', 9);
            $table->string('accent', 9);
            $table->string('accent_variant', 9);
            $table->string('background', 9);
            $table->string('background_variant', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
