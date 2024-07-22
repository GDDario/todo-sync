<?php

namespace Src\UseCases\TodoList\ChangePositions;

use Src\Domain\ValueObjects\Uuid;

class ChangePositionsInput
{
    public function __construct(
        public Uuid $todoListUuid,
        public array $positions
    )
    {
    }
}
