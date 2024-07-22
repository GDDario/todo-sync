<?php

namespace Src\Adapters\Repositories\TodoListRepository;

use Src\Domain\Entities\TodoList;
use Src\Domain\ValueObjects\Uuid;

interface TodoListRepositoryInterface
{
    public function findByUuid(Uuid $uuid): TodoList;

    public function findByUserId(int $userId): array;

    public function insert(StoreTodoListDTO $dto): TodoList;

    public function changePositions(Uuid $todoListUuid, array $positions): bool;
}
