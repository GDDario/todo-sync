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
        Tag::factory()->create(['name' => 'family']);
        Tag::factory()->create(['name' => 'friends']);
        Tag::factory()->create(['name' => 'work']);
        Tag::factory()->create(['name' => 'family']);
        Tag::factory()->create([
            'name' => 'programming',
            'user_id' => User::all()->first()->id
        ]);
    }
}
