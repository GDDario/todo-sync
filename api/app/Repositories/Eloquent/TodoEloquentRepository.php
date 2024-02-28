<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use Src\Adapters\Repositories\TodoRepository\DashboardDTO;
use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;
use Src\Domain\Entities\Todo as TodoEntity;
use Src\Domain\ValueObjects\Uuid;

class TodoEloquentRepository implements TodoRepositoryInterface
{
    public function getDashboard(int $userId): DashboardDTO
    {
        $todosData = DB::table('todos')
            ->selectRaw('COUNT(id) as total_todos')
            ->selectRaw('COUNT(CASE WHEN is_completed = TRUE THEN 1 END) AS completed_todos')
            ->selectRaw('COUNT(CASE WHEN is_urgent = TRUE AND is_completed = false THEN 1 END) AS urgent_todos')
            ->selectRaw('COUNT(CASE WHEN due_date IS NOT NULL AND due_date < NOW() AND is_completed = false THEN 1 END) AS timed_out_todos')
            ->where('user_id', $userId)
            ->first();

        $commitmentsData = Todo::select('due_date', DB::raw('COUNT(*)'))
            ->where('due_date', '>', 'NOW()')
            ->groupBy('due_date')
            ->limit(30)
            ->get()->toArray();

        $tagsData = DB::table('tags')
            ->leftJoin('todo_tag', 'tags.id', '=', 'todo_tag.tag_id')
            ->leftJoin('todos', 'todo_tag.todo_id', '=', 'todos.id')
            ->where('todos.user_id', $userId)
            ->select('tags.name', DB::raw('COUNT(todo_tag.tag_id) as usage_count'))
            ->groupBy('tags.name')
            ->orderBy('usage_count', 'desc')
            ->take(10)
            ->get()
            ->toArray();

        return new DashboardDTO(
            todos: $todosData,
            commitments: $commitmentsData,
            mostUsedTags: $tagsData
        );
    }

    private function hydrateEntity(Todo $todo): TodoEntity
    {
        return new TodoEntity(
            id: $todo->id,
            uuid: new Uuid($todo->uuid),
            title: $todo->title,
            description: $todo->description,
            dueDate: $todo->due_date,
            isUrgent: $todo->is_urgent,
            scheduleOptions: $todo->schedule_options,
        );
    }
}
