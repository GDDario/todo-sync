<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::all()->random()->id;

        return [
            'uuid' => fake()->uuid(),
            'user_id' => $userId,
            'title' => fake()->text(50),
            'description' => fake()->text(),
            'due_date' => fake()->date(),
            'scheduled' => fake()->boolean(),
        ];
    }
}
