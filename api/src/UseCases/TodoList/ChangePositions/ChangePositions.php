<?php

namespace Src\UseCases\TodoList\ChangePositions;

use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;

class ChangePositions
{
    public function __construct(
        private TodoListRepositoryInterface $repository
    )
    {
    }

    public function handle(ChangePositionsInput $input): ChangePositionsOutput
    {
        $result = $this->repository->changePositions($input->todoListUuid, $input->positions);

        return new ChangePositionsOutput(
            $result
        );
    }
}
