<?php

namespace Src\UseCases\Todo\ToggleTodoState;

use Src\Domain\ValueObjects\Uuid;

class ToggleTodoStateInput
{
    public function __construct(
        public Uuid $uuid
    )
    {
    }
}
