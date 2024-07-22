<?php

namespace Database\Factories;

use App\Models\TeamTodo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTeamTodo>
 */
class UserTeamTodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::all()->random()->id;
        $teamTodoId = TeamTodo::all()->random()->id;

        return [
            'uuid' => fake()->uuid(),
            'user_id' => User::factory(),
            'team_todo_id' => TeamTodo::factory(),
        ];
    }
}
