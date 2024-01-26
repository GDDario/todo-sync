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
        Schema::create('todo_tag', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->bigInteger('todo_id');
            $table->bigInteger('tag_id');
            $table->timestamps();

            $table->foreign('todo_id')->references('id')->on('todos')->cascadeOnDelete();
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_tags');
    }
};
