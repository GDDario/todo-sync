<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $teams = Team::inRandomOrder()->limit(rand(1, 3))->get();

            foreach($teams as $team) {
                $uuid = Uuid::uuid4()->toString();

                $user->teams()->attach($team, [
                    'uuid' => $uuid,
                ]);
            }
        }
    }
}
