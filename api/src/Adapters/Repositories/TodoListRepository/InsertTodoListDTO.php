<?php

namespace Src\Adapters\Repositories\TodoListRepository;

use Src\Domain\ValueObjects\Uuid;

class InsertTodoListDTO
{
    public function __construct(
        public int $userId,
        public Uuid $uuid,
        public string $name,
        public bool $isCollaborative,
        public array $collaboratorsUuids
    ) {
    }
}
