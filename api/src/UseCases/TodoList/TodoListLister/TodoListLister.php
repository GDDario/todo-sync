<?php

namespace Src\UseCases\TodoList\TodoListLister;

use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;

class TodoListLister
{
    public function __construct(
        private TodoListRepositoryInterface $repository
    ) {
    }

    public function handle(TodoListListerInput $input): TodoListListerOutput {
        $todoListsSimplified = $this->repository->findByUserId($input->userId);

        return new TodoListListerOutput(
            $todoListsSimplified
        );
    }
}
