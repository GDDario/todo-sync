<?php

namespace Src\UseCases\Todo\CreateTodo;

use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Adapters\Repositories\TodoRepository\StoreTodoDTO;
use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;
use Src\Domain\ValueObjects\Uuid;

class CreateTodo
{
    public function __construct(
        private TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(CreateTodoInput $input): CreateTodoOutput
    {
        $dto = new StoreTodoDTO(
            uuid: new Uuid(Uuidv4::uuid4()),
            title: $input->title,
            todoListUuid: $input->todoListUuid,
            userId: $input->userId,
            tags: $input->tags,
            isUrgent: $input->isUrgent,
            todoGroupUuid: $input->todoGroupUuid,
            description: $input->description,
            dueDate: $input->dueDate,
            scheduleOptions: $input->scheduleOptions
        );

        $todo = $this->repository->insert($dto);

        return new CreateTodoOutput(
            uuid: $todo->uuid,
            title: $todo->title,
            isUrgent: $todo->isUrgent,
            tags: $todo->tags,
            todoGroupUuid: $todo->todoGroupUuid,
            dueDate: $todo->dueDate,
            isCompleted: false,
            description: $todo->description,
            scheduleOptions: $todo->scheduleOptions,
            createdAt: $todo->createdAt,
        );
    }
}
