<?php

namespace Database\Seeders;

use App\Models\TeamTodo;
use App\Models\TeamTodos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamTodo::factory(10)->create();
    }
}
