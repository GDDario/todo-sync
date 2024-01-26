<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TeamTodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teamId = Team::all()->random()->id;
        $userId = User::all()->random()->id;

        return [
            'uuid' => fake()->uuid(),
            'team_id' => $teamId,
            'title' => fake()->text(50),
            'description' => fake()->text(),
            'due_date' => fake()->date(),
            'scheduled' => fake()->boolean(),
            'creator_user_id' => $userId
        ];
    }
}
