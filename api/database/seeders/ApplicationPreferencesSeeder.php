<?php

namespace Database\Seeders;

use App\Models\ApplicationPreferences;
use App\Models\FontFactor;
use App\Models\Language;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationPreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $themeId = Theme::where('name', 'Cyan blue')->first();
        $fontSizeId = FontFactor::where('value', '100')->first();
        $languageId = Language::where('name', 'english')->first();

        foreach ($users as $user) {
            ApplicationPreferences::factory()->create([
                'user_id' => $user->id,
                'theme_id' => $themeId,
                'font_factor_id' => $fontSizeId,
                'language_id' => $languageId,
            ]);
        }
    }
}
