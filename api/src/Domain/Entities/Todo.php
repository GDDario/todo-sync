<?php

namespace Src\Domain\Entities;

use App\Models\Tag;
use App\Models\TodoList;
use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class Todo
{
    public function __construct(
        public int                $id,
        public Uuid               $uuid,
        public string             $title,
        public bool               $isUrgent,
        public array              $tags,
        public ?DateTimeInterface $dueDate = null,
        public ?bool              $isCompleted = null,
        public ?string            $description = null,
        public ?string            $scheduleOptions = null,
        public ?User              $user = null,
        public ?TodoList          $todoList = null,
        public ?Uuid              $todoGroupUuid = null,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $updatedAt = null,
    )
    {
    }
}
