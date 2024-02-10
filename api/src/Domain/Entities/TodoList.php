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
        public ?User $user,
        public ?array $todos,
        public ?DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
    ) {
    }
}
