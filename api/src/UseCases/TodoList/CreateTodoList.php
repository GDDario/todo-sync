<?php

namespace Src\UseCases\TodoList;

use Src\Adapters\Repositories\TodoListRepository\InsertTodoListDTO;
use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
use Src\Domain\ValueObjects\Uuid;
use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Adapters\Authentication\AuthenticationInterface;
use Src\UseCases\User\GetUserFromToken\GetUserFromToken;

class CreateTodoList
{
    public function __construct(
        private TodoListRepositoryInterface $repository,
        private AuthenticationInterface $authentication
    ) {
    }

    public function handle(CreateTodoListInput $input): CreateTodoListOutput
    {
        $dto = new InsertTodoListDTO(
            uuid: new Uuid(Uuidv4::uuid4()->toString()),
            name: $input->name,
            isCollaborative: $input->isCollaborative,
            userId: $input->userId
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
