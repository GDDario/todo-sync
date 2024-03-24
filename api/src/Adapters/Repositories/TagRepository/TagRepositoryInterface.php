<?php

namespace Src\Adapters\Repositories\TagRepository;

interface TagRepositoryInterface
{
    public function findByUserId(int $userId): array;
}
