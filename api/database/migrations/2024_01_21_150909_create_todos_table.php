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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->boolean('is_urgent')->default(false);
            $table->string('schedule_options')->nullable();
            $table->boolean('is_completed');
            $table->bigInteger('todo_list_id');
            $table->bigInteger('todo_group_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('todo_list_id')->references('id')->on('todo_lists')->cascadeOnDelete();
            $table->foreign('todo_group_id')->references('id')->on('todo_groups')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
