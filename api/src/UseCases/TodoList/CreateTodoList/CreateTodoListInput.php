<?php

namespace Src\UseCases\TodoList\CreateTodoList;

class CreateTodoListInput
{
    public function __construct(
        public int $userId,
        public string $name,
        public bool $isCollaborative,
        public ?array $collaboratorsUuids = null
    ) {
        if ($this->collaboratorsUuids == null) {
            $this->collaboratorsUuids = [];
        }
    }
}
