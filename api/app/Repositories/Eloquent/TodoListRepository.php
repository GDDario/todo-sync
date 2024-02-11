<?php

namespace App\Repositories\Eloquent;

use App\Models\TodoList;
use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
use Src\Adapters\Repositories\TodoListRepository\InsertTodoListDTO;
use Src\Domain\Entities\TodoList as TodoListEntity;
use Src\Domain\Exceptions\ValueAlreadyTakenException;

class TodoListRepository implements TodoListRepositoryInterface
{
    public function insert(InsertTodoListDTO $dto): TodoListEntity {
        if (TodoList::where('name', '=', $dto->name)->where('user_id', '=', $dto->userId)->exists()) {
            throw new ValueAlreadyTakenException('Name');
        }

        $user = TodoList::create([
            'uuid' => $dto->uuid,
            'name' => $dto->name,
            'is_collaborative' => $dto->isCollaborative,
            'user_id' => $dto->userId
        ]);

        return $this->hydrateEntity($user);
    }

    private function hydrateEntity(TodoList $todoList): TodoListEntity
    {
        return new TodoListEntity(
            id: $todoList->id,
            uuid: $todoList->uuid,
            name: $todoList->name,
            isCollaborative: $todoList->is_collaborative,
            createdAt: $todoList->created_at,
            updatedAt: $todoList->updated_at
        );
    }
}
