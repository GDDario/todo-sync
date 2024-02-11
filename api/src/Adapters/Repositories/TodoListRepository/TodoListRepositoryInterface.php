<?php

namespace Src\Adapters\Repositories\TodoListRepository;

use Src\Domain\Entities\TodoList;
use Src\Adapters\Repositories\TodoListRepository\InsertTodoListDTO;

interface TodoListRepositoryInterface
{
    public function insert(InsertTodoListDTO $dto): TodoList;
}
