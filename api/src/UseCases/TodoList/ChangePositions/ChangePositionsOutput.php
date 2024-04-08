<?php

namespace Src\UseCases\TodoList\ChangePositions;

class ChangePositionsOutput
{
    public function __construct(
        public bool $success
    )
    {
    }
}
