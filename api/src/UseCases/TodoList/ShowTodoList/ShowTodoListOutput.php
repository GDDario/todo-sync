<?php

namespace Src\UseCases\TodoList\ShowTodoList;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class ShowTodoListOutput
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public bool $isCollaborative,
        public DateTimeInterface $createdAt,
        public DateTimeInterface $updatedAt,
    )
    {

    }
}
