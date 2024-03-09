<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Models\Todo;
use App\Models\TodoGroup;
use App\Models\TodoList;
use Illuminate\Support\Facades\DB;
use Src\Adapters\Repositories\TodoRepository\DashboardDTO;
use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;
use Src\Adapters\Repositories\TodoRepository\TodosDTO;
use Src\Domain\Entities\Todo as TodoEntity;
use Src\Domain\Entities\Tag as TagEntity;
use Src\Domain\Entities\TodoGroup as TodoGroupEntity;
use Src\Domain\Exceptions\EntityNotFoundException;
use Src\Domain\ValueObjects\Uuid;

class TodoEloquentRepository implements TodoRepositoryInterface
{
    public function findByTodoList(Uuid $todoListUuid): TodosDTO
    {
        if (!$todoList = TodoList::where('uuid', $todoListUuid)->first()) {
            throw new EntityNotFoundException("TodoList with uuid $todoListUuid not found");
        }

        $ungroupedTodos = Todo::where('todo_list_id', $todoList->id)
            ->whereNull('todo_group_id')->get();
        $todoGroups = TodoGroup::where('todo_list_id', $todoList->id)->with('todos')->get();


        $ungroupedTodos = $ungroupedTodos->map(fn(Todo $todo) => $this->hydrateEntity($todo))->toArray();
        $groupedTodos = [];
        foreach ($todoGroups as $todoGroup) {
            $groupedTodos[] = $this->hydrateTodoGroupEntity($todoGroup);
        }

        return new TodosDTO(
            $groupedTodos,
            $ungroupedTodos
        );
    }

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
        $tags = $todo->tags()->get()
            ->map(fn(Tag $tag) => TagEntity::createFromModel($tag))
            ->toArray();

        return new TodoEntity(
            id: $todo->id,
            uuid: new Uuid($todo->uuid),
            title: $todo->title,
            dueDate: $todo->due_date,
            isUrgent: $todo->is_urgent,
            tags: $tags,
            isCompleted: $todo->is_completed,
            description: $todo->description,
            scheduleOptions: $todo->schedule_options,
        );
    }

    private function hydrateTodoGroupEntity(TodoGroup $todoGroup): TodoGroupEntity {
        $todos = $todoGroup->todos()->get()->map(fn(Todo $todo) => $this->hydrateEntity($todo))->toArray();

        return new TodoGroupEntity(
            id: $todoGroup->id,
            uuid: new Uuid($todoGroup->uuid),
            name: $todoGroup->name,
            todos: $todos,
            createdAt: $todoGroup->created_at,
        );
    }
}
