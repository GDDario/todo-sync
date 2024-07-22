<?php

namespace Src\Adapters\Repositories\TodoListRepository;

use Src\Domain\ValueObjects\Uuid;

class StoreTodoListDTO
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
