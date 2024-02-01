<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'Test usa',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'username' => 'anotha testa usa',
            'email' => 'anotha_test@example.com',
        ]);
    }
}
