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
        public bool $isUrgent,
        public bool $isCompleted,
        public ?string $scheduleOptions = null,
        public ?User $user = null,
        public ?TodoList $todoList = null,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $updatedAt = null,
    ) {
    }
}
