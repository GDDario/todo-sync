<?php

namespace Src\UseCases\Todo\GetTodosByTodoListUuid;

use Src\Domain\ValueObjects\Uuid;

class GetTodosByTodoListUuidInput
{
    public function __construct(
        public Uuid $todoListUuid
    )
    {
    }
}
