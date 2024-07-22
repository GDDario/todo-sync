<?php

namespace Src\UseCases\Todo\UpdateTodoTitle;

use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;

class UpdateTodoTitle
{
    public function __construct(
        public TodoRepositoryInterface $repository
    )
    {
    }

    public function handle(UpdateTodoTitleInput $input)
    {
        $this->repository->updateTitle($input->uuid, $input->title);
    }
}
