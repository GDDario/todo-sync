<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::factory(10)->create();

        $this->updateTodoListsPositions();
    }

    private function updateTodoListsPositions(): void
    {
        $lists = TodoList::all();

        foreach ($lists as $list) {
            $todosUuids = [];
            $todos = Todo::where('todo_list_id', $list->id)->get();

            foreach ($todos as $todo) {
                $todosUuids[] = $todo->uuid;
            }

            $positions = json_encode($todosUuids);
            $list->update(['positions' => $positions]);
        }
    }
}
