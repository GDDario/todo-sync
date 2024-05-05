<?php

namespace Src\Adapters\Repositories\UserRepository;

use Src\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findById(int $id): User;

    public function findByEmail(string $email): User;

    public function insert(RegisterUserDTO $dto): User;

    public function updateUsernameAndPicture(UpdateUsernameAndPictureDTO $dto): User;
}
