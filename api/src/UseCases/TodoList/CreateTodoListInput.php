<?php

namespace Src\UseCases\TodoList;

class CreateTodoListInput
{
    public function __construct(
        public string $name,
        public bool $isCollaborative,
        public int $userId
    )
    {
    }
}
