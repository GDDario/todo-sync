<?php

namespace Src\Adapters\Repositories\UserRepository;

use Src\Adapters\Repositories\UserRepository\RegisterUserDTO;
use Src\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function insert(RegisterUserDTO $registerUser): User;
}
