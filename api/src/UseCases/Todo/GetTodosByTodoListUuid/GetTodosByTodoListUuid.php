<?php

namespace Src\UseCases\Todo\GetTodosByTodoListUuid;

use App\Repositories\Eloquent\TodoEloquentRepository;
use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;

class GetTodosByTodoListUuid
{
    public function __construct(
        private TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(GetTodosByTodoListUuidInput $input): GetTodosByTodoListUuidOutput
    {
        $response = $this->repository->findByTodoList($input->todoListUuid);

        return new GetTodosByTodoListUuidOutput(
//            todoGroups: $response->todoGroups,
            todos: $response->todos,
            positions: $response->positions
        );
    }
}
