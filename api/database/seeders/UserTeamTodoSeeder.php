<?php

namespace Database\Seeders;

use App\Models\TeamTodo;
use App\Models\User;
use App\Models\UserTeam;
use App\Models\UserTeamTodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserTeamTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $teamTodos = TeamTodo::inRandomOrder()->limit(rand(1, 3))->get();

            foreach($teamTodos as $teamTodo) {
                $uuid = Uuid::uuid4()->toString();

                $user->teamTodos()->attach($teamTodo, [
                    'uuid' => $uuid,
                ]);
            }
        }
    }
}
