<?php

namespace Src\UseCases\Todo\ToggleTodoState;

use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;

class ToggleTodoState
{
    public function __construct(
        private TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(ToggleTodoStateInput $input): ToggleTodoStateOutput
    {
        $newState = $this->repository->toggleState($input->uuid);

        return new ToggleTodoStateOutput(
            $newState
        );
    }
}
