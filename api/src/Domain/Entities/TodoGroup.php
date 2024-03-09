<?php

namespace Src\Domain\Entities;

use App\Models\TodoList;
use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class TodoGroup
{
    public function __construct(
        public int                $id,
        public Uuid               $uuid,
        public string             $name,
        public ?array             $todos,
        public ?User              $user = null,
        public ?TodoList          $todoList = null,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $updatedAt = null,
    )
    {
    }
}
