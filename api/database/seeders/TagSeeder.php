<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()->create(['name' => 'family', 'color' => '#3471eb']);
        Tag::factory()->create(['name' => 'friends', 'color' => '#b7eb34']);
        Tag::factory()->create(['name' => 'work', 'color' => '#381610']);
        Tag::factory()->create([
            'name' => 'programming',
            'user_id' => User::all()->first()->id
        ]);
    }
}
