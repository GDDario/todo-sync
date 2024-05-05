<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::factory()->create([
            'name' => 'english',
            'tag' => 'en'
        ]);

        Language::factory()->create([
            'name' => 'português',
            'tag' => 'pt'
        ]);

        Language::factory()->create([
            'name' => 'español',
            'tag' => 'es'
        ]);
    }
}
