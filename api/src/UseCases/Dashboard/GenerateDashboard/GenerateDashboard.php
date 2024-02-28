<?php

namespace Src\UseCases\Dashboard\GenerateDashboard;

use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;

class GenerateDashboard
{
    public function __construct(
        private TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(GenerateDashboardInput $inputDTO): GenerateDashboardOutput
    {
        $data = $this->repository->getDashboard($inputDTO->userId);
        $pendingTodos = $data->todos->total_todos - $data->todos->completed_todos;

        return new GenerateDashboardOutput(
            todos: [
                'total' => $data->todos->total_todos,
                'completed' => $data->todos->completed_todos,
                'pending' => $pendingTodos,
                'urgent' => $data->todos->urgent_todos,
                'timed_out' => $data->todos->timed_out_todos
            ],
            commitments: $data->commitments,
            mostUsedTags: $data->mostUsedTags
        );
    }
}
