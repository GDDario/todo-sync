<?php

namespace Src\UseCases\LoginUser;

use Src\Adapters\Authentication\AuthenticationInterface;
use Src\Adapters\Repositories\UserRepository\LoginUserDTO;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\ValueObjects\Email;

class LoginUser
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private AuthenticationInterface $authenticationAdapter
    ) {
    }

    public function handle(LoginUserInput $input): LoginUserOutput
    {
        $credentials = [
            'email' => $input->email,
            'password' => $input->password
        ];

        $output = $this->authenticationAdapter->login($credentials);

        return $output;
    }
}
