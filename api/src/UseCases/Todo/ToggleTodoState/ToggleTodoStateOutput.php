<?php

namespace Src\UseCases\Todo\ToggleTodoState;

class ToggleTodoStateOutput
{
    public function __construct(
        public bool $newState
    )
    {
    }
}
