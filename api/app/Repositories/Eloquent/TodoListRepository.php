<?php

namespace App\Repositories\Eloquent;

use App\Models\TodoList;
use App\Models\Pivots\TodoListUser;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
use Src\Adapters\Repositories\TodoListRepository\InsertTodoListDTO;
use Src\Domain\Entities\TodoList as TodoListEntity;
use Src\Domain\Exceptions\ValueAlreadyTakenException;
use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Domain\ValueObjects\Uuid;

class TodoListRepository implements TodoListRepositoryInterface
{
    public function insert(InsertTodoListDTO $dto): TodoListEntity
    {
        DB::beginTransaction();

        try {
            if (TodoList::where('name', '=', $dto->name)->where('user_id', '=', $dto->userId)->exists()) {
                throw new ValueAlreadyTakenException('Name');
            }

            $todoList = TodoList::create([
                'uuid' => $dto->uuid,
                'name' => $dto->name,
                'is_collaborative' => $dto->isCollaborative,
                'user_id' => $dto->userId
            ]);

            if (count($dto->collaboratorsUuids) > 0) {
                foreach ($dto->collaboratorsUuids as $collaboratorUuid) {
                    $user = User::where('uuid', $collaboratorUuid)->first();

                    TodoListUser::create([
                        'uuid' => Uuidv4::uuid4()->__toString(),
                        'todo_list_id' => $todoList->id,
                        'user_id' => $user->id
                    ]);
                }
            }

            DB::commit();

            return $this->hydrateEntity($todoList);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function findByUserId(int $userId): array
    {
        $todoLists = TodoList::where('user_id', $userId)->get();

        return $todoLists->map(function($todoList) {
            return $this->hydrateEntity($todoList);
        })->toArray();
    }

    private function hydrateEntity(TodoList $todoList): TodoListEntity
    {
        return new TodoListEntity(
            id: $todoList->id,
            uuid: new Uuid($todoList->uuid),
            name: $todoList->name,
            isCollaborative: $todoList->is_collaborative,
            createdAt: $todoList->created_at,
            updatedAt: $todoList->updated_at
        );
    }
}
