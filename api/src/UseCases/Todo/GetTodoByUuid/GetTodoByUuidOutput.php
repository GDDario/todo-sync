<?php

namespace Src\UseCases\Todo\GetTodoByUuid;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class GetTodoByUuidOutput
{
    public function __construct(
        public Uuid               $uuid,
        public string             $title,
        public bool               $isUrgent,
        public array              $tags,
        public ?DateTimeInterface $dueDate,
        public ?bool              $isCompleted,
        public ?string            $description,
        public ?string            $scheduleOptions,
        public ?DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt
    )
    {
    }
}
