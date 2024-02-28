<?php

namespace Src\Adapters\Repositories\TodoRepository;

interface TodoRepositoryInterface
{
    public function getDashboard(int $userId): DashboardDTO;
}
