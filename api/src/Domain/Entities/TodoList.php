<?php

namespace Src\Domain\Entities;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class TodoList
{
    public function __construct(
        public int $id,
        public Uuid $uuid,
        public string $name,
        public bool $isCollaborative = false,
        public string $positions = '[]',
        public ?User $user = null,
        public ?array $todos = null,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $updatedAt = null,
    ) {
    }
}
