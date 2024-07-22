<?php

namespace Src\Adapters\Repositories\TodoRepository;

use Src\Domain\Entities\Todo;
use Src\Domain\ValueObjects\Uuid;

interface TodoRepositoryInterface
{
    public function findByTodoList(Uuid $todoListUuid): TodosDTO;

    public function findByUuid(Uuid $uuid): Todo;

    public function getDashboard(int $userId): DashboardDTO;

    public function store(StoreTodoDTO $dto): Todo;

    public function update(UpdateTodoDTO $dto): Todo;

    public function toggleState(Uuid $uuid): bool;

    public function updateTitle(Uuid $uuid, string $title): void;
}
