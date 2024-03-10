<?php

namespace Src\UseCases\TodoList\CreateTodoList;

use Src\Adapters\Repositories\TodoListRepository\StoreTodoListDTO;
use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
use Src\Domain\ValueObjects\Uuid;
use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Adapters\Authentication\AuthenticationInterface;

class CreateTodoList
{
    public function __construct(
        private TodoListRepositoryInterface $repository
    ) {
    }

    public function handle(CreateTodoListInput $input): CreateTodoListOutput
    {
        $dto = new StoreTodoListDTO(
            userId: $input->userId,
            uuid: new Uuid(Uuidv4::uuid4()->toString()),
            name: $input->name,
            isCollaborative: $input->isCollaborative,
            collaboratorsUuids: $input->collaboratorsUuids
        );

        $todoList = $this->repository->insert($dto);

        return new CreateTodoListOutput(
            uuid: $todoList->uuid,
            name: $todoList->name,
            isCollaborative: $todoList->isCollaborative,
            createdAt: $todoList->createdAt
        );
    }
}
