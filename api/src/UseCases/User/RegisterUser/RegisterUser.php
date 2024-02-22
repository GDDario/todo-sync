<?php

namespace Src\UseCases\User\RegisterUser;

use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Adapters\Repositories\UserRepository\RegisterUserDTO;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\Exceptions\PasswordMatchingException;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class RegisterUser
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @throws PasswordMatchingException
     */
    public function handle(RegisterUserInput $input): RegisterUserOutput
    {
        if ($input->password !== $input->confirmPassword) {
            throw new PasswordMatchingException();
        }

        $registerUserDto = new RegisterUserDTO(
            uuid: new Uuid(Uuidv4::uuid4()->toString()),
            username: $input->username,
            email: new Email($input->email),
            password: Hash::make($input->password)
        );

        $user = $this->repository->insert($registerUserDto);

        return new RegisterUserOutput(
            uuid: $user->uuid,
            username: $user->username,
            email: $user->email,
            createdAt: $user->createdAt
        );
    }
}
