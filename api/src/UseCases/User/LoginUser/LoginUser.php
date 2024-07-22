<?php

namespace Src\UseCases\User\LoginUser;

use Src\Adapters\Authentication\AuthenticationInterface;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;

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
