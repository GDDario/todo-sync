<?php

namespace Src\UseCases\Todo\GetTodosByTodoListUuid;

class GetTodosByTodoListUuidOutput
{
    public function __construct(
//        public array $todoGroups,
        public array $todos,
        public string $positions
    )
    {
    }
}
