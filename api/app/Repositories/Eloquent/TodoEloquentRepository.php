<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Models\Todo;
use App\Models\TodoGroup;
use App\Models\TodoList;
use Exception;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Adapters\Repositories\TodoRepository\DashboardDTO;
use Src\Adapters\Repositories\TodoRepository\StoreTodoDTO;
use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;
use Src\Adapters\Repositories\TodoRepository\TodosDTO;
use Src\Adapters\Repositories\TodoRepository\UpdateTodoDTO;
use Src\Domain\Entities\Tag as TagEntity;
use Src\Domain\Entities\Todo as TodoEntity;
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
        $groupedTodos = TodoGroup::where('todo_list_id', $todoList->id)->with('todos')->get();

        $ungroupedTodos = $ungroupedTodos->map(fn(Todo $todo) => $this->hydrateEntity($todo))->toArray();

        $todoGroups = [];
        foreach ($groupedTodos as $todoGroup) {
            $todoGroups[] = $this->hydrateTodoGroupEntity($todoGroup);
        }

        $positions = $todoList->positions;

        return new TodosDTO(
//            $todoGroups,
            $ungroupedTodos,
            $positions
        );
    }

    public function findByUuid(Uuid $uuid): TodoEntity
    {
        if (!$todo = Todo::where('uuid', $uuid)->first()) {
            throw new EntityNotFoundException("Todo with uuid $uuid not found");
        }

        return $this->hydrateEntity($todo);
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

    public function store(StoreTodoDTO $dto): TodoEntity
    {
        DB::beginTransaction();

        try {
            if (!$todoList = TodoList::where('uuid', $dto->todoListUuid)->first()) {
                throw new EntityNotFoundException("TodoList with uuid $dto->todoListUuid not found");
            }

            if ($dto->todoGroupUuid && !$todoGroup = TodoGroup::where('uuid', $dto->todoGroupUuid)->first()) {
                throw new EntityNotFoundException("TodoGroup with uuid $dto->todoGroupUuid not found");
            }

            $insertData = [
                'uuid' => $dto->uuid,
                'title' => $dto->title,
                'is_completed' => false,
                'user_id' => $dto->userId,
                'todo_list_id' => $todoList->id,
                'due_date' => $dto->dueDate,
                'todo_group_id' => isset($todoGroup->id) ? $todoGroup->id : null,
                'description' => $dto->description,
                'is_urgent' => $dto->isUrgent,
                'schedule_options' => $dto->scheduleOptions
            ];

            $todo = Todo::create($insertData);
            if ($todo && !empty($dto->tags)) {
                foreach ($dto->tags as $tagUuid) {
                    if (!$tag = Tag::where('uuid', $tagUuid)->first()) {
                        throw new EntityNotFoundException("Tag with uuid $tagUuid not found");
                    }

                    $todo->tags()->attach($tag->id, ['uuid' => Uuidv4::uuid4()]);
                }
            }

            DB::commit();

            return $this->hydrateEntity($todo);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(UpdateTodoDTO $dto): TodoEntity
    {
        DB::beginTransaction();

        try {
            if (!$todo = Todo::where('uuid', $dto->uuid)->first()) {
                throw new EntityNotFoundException("Todo with uuid $dto->todoListUuid not found");
            }

            if (!$todoList = TodoList::where('uuid', $dto->todoListUuid)->first()) {
                throw new EntityNotFoundException("TodoList with uuid $dto->todoListUuid not found");
            }

            if ($dto->todoGroupUuid && !$todoGroup = TodoGroup::where('uuid', $dto->todoGroupUuid)->first()) {
                throw new EntityNotFoundException("TodoGroup with uuid $dto->todoGroupUuid not found");
            }

            $updateData = [
                'title' => $dto->title,
                'is_completed' => false,
                'user_id' => $dto->userId,
                'todo_list_id' => $todoList->id,
                'due_date' => $dto->dueDate,
                'todo_group_id' => isset($todoGroup->id) ? $todoGroup->id : null,
                'description' => $dto->description,
                'is_urgent' => $dto->isUrgent,
                'schedule_options' => $dto->scheduleOptions
            ];

            $todo->update($updateData);
            $todo->refresh();

            DB::commit();

            return $this->hydrateEntity($todo);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function toggleState(Uuid $uuid): bool
    {
        if (!$todo = Todo::where('uuid', $uuid)->first()) {
            throw new EntityNotFoundException("Todo with uuid $uuid not found");
        }

        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);
        $todo->refresh();

        return $todo->is_completed;
    }

    public function updateTitle(Uuid $uuid, string $title): void
    {
        if (!$todo = Todo::where('uuid', $uuid)->first()) {
            throw new EntityNotFoundException("Todo with uuid $uuid not found");
        }

        $todo->update([
            'title' => $title
        ]);
    }

    private function hydrateEntity(Todo $todo): TodoEntity
    {
        $tags = $todo->tags()->get()
            ->map(fn(Tag $tag) => TagEntity::createFromModel($tag))
            ->toArray();

        $todoGroup = $todo->group()->first();
        $todoGroupUuid = $todoGroup ? new Uuid($todoGroup->uuid) : null;

        return new TodoEntity(
            id: $todo->id,
            uuid: new Uuid($todo->uuid),
            title: $todo->title,
            isUrgent: $todo->is_urgent,
            tags: $tags,
            dueDate: $todo->due_date,
            isCompleted: $todo->is_completed,
            description: $todo->description,
            scheduleOptions: $todo->schedule_options,
            todoGroupUuid: $todoGroupUuid,
        );
    }

    private function hydrateTodoGroupEntity(TodoGroup $todoGroup): TodoGroupEntity
    {
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
