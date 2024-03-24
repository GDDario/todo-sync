<?php

namespace Src\UseCases\Todo\CreateTodo;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class CreateTodoInput
{
    public function __construct(
        public string             $title,
        public Uuid               $todoListUuid,
        public int                $userId,
        public array              $tags,
        public ?Uuid              $todoGroupUuid = null,
        public ?string            $description = null,
        public ?DateTimeInterface $dueDate = null,
        public ?bool              $isUrgent = null,
        public ?string            $scheduleOptions = null
    )
    {
    }
}
