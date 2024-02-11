<?php

namespace Src\Adapters\Repositories\TodoListRepository;

use Src\Domain\ValueObjects\Uuid;

class InsertTodoListDTO
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public bool $isCollaborative,
        public int $userId
    ) {
    }
}
