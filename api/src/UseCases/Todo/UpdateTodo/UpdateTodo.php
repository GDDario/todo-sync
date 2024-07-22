<?php

namespace Src\UseCases\Todo\UpdateTodo;

use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;
use Src\Adapters\Repositories\TodoRepository\UpdateTodoDTO;

class UpdateTodo
{
    public function __construct(
        private TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(UpdateTodoInput $input): UpdateTodoOutput
    {
        $dto = new UpdateTodoDTO(
            uuid: $input->uuid,
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

        $todo = $this->repository->update($dto);

        return new UpdateTodoOutput(
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
            updatedAt: $todo->updatedAt
        );
    }
}
