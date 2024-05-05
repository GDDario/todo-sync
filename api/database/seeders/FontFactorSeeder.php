<?php

namespace Database\Seeders;

use App\Models\FontFactor;
use Illuminate\Database\Seeder;

class FontFactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            '50',
            '75',
            '100',
            '125',
            '150',
        ];

        foreach ($values as $value) {
            FontFactor::factory()->create([
                'value' => $value,
            ]);
        }
    }
}
