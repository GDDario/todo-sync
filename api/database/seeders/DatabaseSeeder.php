<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FontFactor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            TodoListSeeder::class,
            TodoGroupSeeder::class,
            TodoSeeder::class,
            TagSeeder::class,
            ThemeSeeder::class,
            LanguageSeeder::class,
            FontFactorSeeder::class,
            ApplicationPreferencesSeeder::class
        ]);
    }
}
