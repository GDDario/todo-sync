<?php

namespace Src\Adapters\Repositories\TodoRepository;

use Src\Domain\Entities\Todo;
use Src\Domain\ValueObjects\Uuid;

interface TodoRepositoryInterface
{
    public function findByTodoList(Uuid $todoListUuid): TodosDTO;
    public function getDashboard(int $userId): DashboardDTO;
}
