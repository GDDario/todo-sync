<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Src\Adapters\Repositories\UserRepository\RegisterUserDTO;
use Src\Adapters\Repositories\UserRepository\UpdateUsernameAndPictureDTO;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\Entities\User as UserEntity;
use Src\Domain\Exceptions\EntityNotFoundException;
use Src\Domain\Exceptions\ValueAlreadyTakenException;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function findById(int $id): UserEntity
    {
        if (!$user = User::find( $id)->first()) {
            throw new EntityNotFoundException(
                "User not found"
            );
        }

        return $this->hydrateEntity($user);
    }

    public function findByEmail(string $email): UserEntity
    {
        if (!$user = User::where('email', $email)->first()) {
            throw new EntityNotFoundException(
                "User with email $email not found"
            );
        }

        return $this->hydrateEntity($user);
    }

    public function store(RegisterUserDTO $dto): UserEntity
    {
        $query = User::query();

        if (User::where('username', '=', $dto->username)->exists()) {
            throw new ValueAlreadyTakenException('Username');
        }
        if (User::where('email', '=', $dto->email)->exists()) {
            throw new ValueAlreadyTakenException('Email');
        }

        $user = $query->create([
            'uuid' => $dto->uuid,
            'username' => $dto->username,
            'email' => $dto->email,
            'password' => $dto->password
        ]);

        return $this->hydrateEntity($user);
    }

    public function updateUsernameAndPicture(UpdateUsernameAndPictureDTO $dto): UserEntity
    {
        if (!$user = User::find($dto->userId)) {
            throw new EntityNotFoundException('User not found');
        }

        $newUserData = ['username' => $dto->username];

        if ($dto->changingPicture) {
            $newUserData['picture_path'] = $dto->picturePath;
        }

        $user->update($newUserData);
        $user->refresh();

        return $this->hydrateEntity($user);
    }

    public function updateEmailByUserId(int $userId, string $email): void
    {
        if (!$user = User::find($userId)) {
            throw new EntityNotFoundException('User not found');
        }

        $newUserData = ['email' => $email];

        $user->update($newUserData);
    }

    private function hydrateEntity(User $user): UserEntity
    {
        return new UserEntity(
            id: $user->id,
            uuid: new Uuid($user->uuid),
            username: $user->username,
            email: new Email($user->email),
            picturePath: $user->picture_path,
            createdAt: $user->created_at,
            editedAt: $user->edited_at
        );
    }
}
