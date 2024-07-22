<?php

namespace Src\UseCases\TodoList\CreateTodoList;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class CreateTodoListOutput
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public bool $isCollaborative,
        public DateTimeInterface $createdAt
    )
    {

    }
}
