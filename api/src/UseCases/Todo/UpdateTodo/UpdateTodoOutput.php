<?php

namespace Src\UseCases\Todo\UpdateTodo;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class UpdateTodoOutput
{
    public function __construct(
        public Uuid               $uuid,
        public string             $title,
        public bool               $isUrgent,
        public array              $tags,
        public ?Uuid              $todoGroupUuid = null,
        public ?DateTimeInterface $dueDate = null,
        public ?bool              $isCompleted = null,
        public ?string            $description = null,
        public ?string            $scheduleOptions = null,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $updatedAt = null
    )
    {
    }
}
