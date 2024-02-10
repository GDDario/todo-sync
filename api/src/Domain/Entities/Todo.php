<?php

namespace Src\Domain\Entities;

use App\Models\TodoList;
use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class Todo
{
    public function __construct(
        public int $id,
        public Uuid $uuid,
        public string $title,
        public string $description,
        public DateTimeInterface $dueDate,
        public bool $scheduled,
        public ?User $user,
        public ?TodoList $todoList,
        public ?DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
    ) {
    }
}
