<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Src\Adapters\Repositories\UserRepository\RegisterUserDTO;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\Entities\User as UserEntity;
use Src\Domain\Exceptions\ValueAlreadyTakenException;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): array {
        $users = User::where('email', 'LIKE', "$email%")->get();

        return $users->map(function($user) {
            return $this->hydrateEntity($user);
        })->toArray();
    }

    public function insert(RegisterUserDTO $dto): UserEntity
    {
        if (User::where('username', '=', $dto->username)->exists()) {
            throw new ValueAlreadyTakenException('Username');
        }
        if (User::where('email', '=', $dto->email)->exists()) {
            throw new ValueAlreadyTakenException('Email');
        }

        $user = User::create([
            'uuid' => $dto->uuid,
            'username' => $dto->username,
            'email' => $dto->email,
            'password' => $dto->password
        ]);

        return $this->hydrateEntity($user);
    }

    private function hydrateEntity(User $user): UserEntity
    {
        return new UserEntity(
            id: $user->id,
            uuid: new Uuid($user->uuid),
            username: $user->username,
            email: new Email($user->email),
            createdAt: $user->created_at,
            editedAt: $user->editedAt
        );
    }
}
