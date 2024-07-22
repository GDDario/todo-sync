<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::all()->first()->id;

        return [
            'uuid' => fake()->uuid(),
            'name' => fake()->text(15),
            'user_id' => $userId,
            'is_collaborative' => false,
        ];
    }
}
