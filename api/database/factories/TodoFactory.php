<?php

namespace Database\Factories;

use App\Models\TodoList;
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
        $todoListId = TodoList::all()->random()->id;

        return [
            'uuid' => fake()->uuid(),
            'user_id' => $userId,
            'todo_list_id' => $todoListId,
            'title' => fake()->text(50),
            'description' => fake()->text(),
            'due_date' => fake()->date(),
            'is_urgent' => fake()->boolean(),
            'schedule_options' => null,
            'is_completed' => false,
        ];
    }
}
