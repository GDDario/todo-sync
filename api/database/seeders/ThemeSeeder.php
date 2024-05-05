<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theme::factory()->create([
            'name' => 'Cyan blue',
            'primary' => '#0C88A4',
            'primary_variant' => '#0B7087',
            'secondary' => '#8A3434',
            'secondary_variant' => '#A3700B',
            'accent' => '#A3950B',
            'accent_variant' => '#7D732F',
            'background' => '#F1F5F9',
            'background_variant' => '#E2E8F0',
        ]);

        Theme::factory()->create([
            'name' => 'Leaf green',
            'primary' => '#475726',
            'primary_variant' => '#38451e',
            'secondary' => '#572E26',
            'secondary_variant' => '#45251e',
            'accent' => '#263657',
            'accent_variant' => '#1d2942',
            'background' => '#F1F5F9',
            'background_variant' => '#E2E8F0',
        ]);

        Theme::factory()->create([
            'name' => 'Brown',
            'primary' => '#574132',
            'primary_variant' => '#3d2e23',
            'secondary' => '#363157',
            'secondary_variant' => '#363157',
            'accent' => '#32592E',
            'accent_variant' => '#254222',
            'background' => '#F1F5F9',
            'background_variant' => '#E2E8F0',
        ]);
    }
}
