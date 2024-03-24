<?php

namespace Src\Adapters\Repositories\UserRepository;

use Src\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function insert(RegisterUserDTO $dto): User;

    public function findByEmail(string $email): User;
}
