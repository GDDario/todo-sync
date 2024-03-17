<?php

namespace Src\UseCases\TodoList\ShowTodoList;

use Src\Domain\ValueObjects\Uuid;

class ShowTodoListInput
{
    public function __construct(
        public Uuid $uuid
    )
    {
    }
}
