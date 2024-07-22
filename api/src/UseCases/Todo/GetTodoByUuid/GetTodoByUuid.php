<?php

namespace Src\UseCases\Todo\GetTodoByUuid;

use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;

class GetTodoByUuid
{
    public function __construct(
        private TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(GetTodoByUuidInput $input): GetTodoByUuidOutput
    {
        $todo = $this->repository->findByUuid($input->uuid);

        return new GetTodoByUuidOutput(
            uuid: $todo->uuid,
            title: $todo->title,
            isUrgent: $todo->isUrgent,
            tags: $todo->tags,
            dueDate: $todo->dueDate,
            isCompleted: $todo->isCompleted,
            description: $todo->description,
            scheduleOptions: $todo->scheduleOptions,
            createdAt: $todo->createdAt,
            updatedAt: $todo->updatedAt
        );
    }
}
