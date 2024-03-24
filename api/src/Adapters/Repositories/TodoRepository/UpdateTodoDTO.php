<?php

namespace Src\Adapters\Repositories\TodoRepository;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class UpdateTodoDTO
{
    public function __construct(
        public Uuid               $uuid,
        public string             $title,
        public Uuid               $todoListUuid,
        public int                $userId,
        public array              $tags,
        public bool               $isUrgent,
        public ?Uuid              $todoGroupUuid = null,
        public ?string            $description = null,
        public ?DateTimeInterface $dueDate = null,
        public ?string            $scheduleOptions = null
    )
    {
    }
}
