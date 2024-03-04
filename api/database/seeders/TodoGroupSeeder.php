<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\TodoGroup;
use Illuminate\Database\Seeder;

class TodoGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TodoGroup::factory(2)->create();
    }
}
