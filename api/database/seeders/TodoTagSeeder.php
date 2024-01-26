<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Todo;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;

class TodoTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = Todo::all();

        foreach ($todos as $todo) {
            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->get();

            foreach($tags as $tag) {
                $uuid = Uuid::uuid4()->toString();

                $todo->tags()->attach($tag, ['uuid' => $uuid]);
            }
        }
    }
}
