<?php

namespace Src\Adapters\Repositories\UserRepository;

use Src\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findById(int $id): User;

    public function findByEmail(string $email): User;

    public function store(RegisterUserDTO $dto): User;

    public function updateUsernameAndPicture(UpdateUsernameAndPictureDTO $dto): User;
    public function updateEmailByUserId(int $userId, string $email): void;
    public function updatePasswordByEmail(string $email, string $password): void;
}
