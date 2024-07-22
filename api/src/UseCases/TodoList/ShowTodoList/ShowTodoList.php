<?php

namespace Src\UseCases\TodoList\ShowTodoList;

use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
use Src\Domain\ValueObjects\Uuid;

class ShowTodoList
{
    public function __construct(
        private TodoListRepositoryInterface $repository
    )
    {
    }

    public function handle(ShowTodoListInput $input): ShowTodoListOutput
    {
        $todoList = $this->repository->findByUuid($input->uuid);

        return new ShowTodoListOutput(
            uuid: new Uuid($todoList->uuid),
            name: $todoList->name,
            isCollaborative: $todoList->isCollaborative,
            createdAt: $todoList->createdAt,
            updatedAt: $todoList->updatedAt
        );
    }
}
