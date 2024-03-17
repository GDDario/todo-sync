<?php

namespace Src\Adapters\Repositories\TodoRepository;

use stdClass;

class TodosDTO
{
    public function __construct(
        public array $todoGroups,
        public array $ungroupedTodos,
        public string $positions
    ) {

    }
}
