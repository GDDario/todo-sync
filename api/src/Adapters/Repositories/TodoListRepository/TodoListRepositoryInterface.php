<?php

namespace Src\Adapters\Repositories\TodoListRepository;

use Src\Domain\Entities\TodoList;
use Src\Adapters\Repositories\TodoListRepository\StoreTodoListDTO;

interface TodoListRepositoryInterface
{
    public function insert(StoreTodoListDTO $dto): TodoList;
    public function findByUserId(int $userId): array;
}
