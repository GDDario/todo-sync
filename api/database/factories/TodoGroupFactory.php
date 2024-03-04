<?php

namespace Database\Factories;

use App\Models\TodoGroup;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoGroupFactory extends Factory
{
    protected $model = TodoGroup::class;

    public function definition(): array
    {
        $userId = User::all()->random()->id;
        $todoListId = TodoList::all()->random()->id;

        return [
            'uuid' => fake()->uuid(),
            'title' => fake()->sentence(),
            'user_id' => $userId,
            'todo_list_id' => $todoListId,
            'created_at' => fake()->dateTime()
        ];
    }
}
