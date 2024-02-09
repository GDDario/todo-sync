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
        Schema::create('todo_list_user', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->bigInteger('todo_list_id');
            $table->bigInteger('user_id');
            $table->timestamps();

            $table->foreign('todo_list_id')->references('id')->on('todo_lists');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_user');
    }
};
