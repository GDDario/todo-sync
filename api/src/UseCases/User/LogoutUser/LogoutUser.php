<?php

namespace Src\UseCases\User\LogoutUser;

use Src\Adapters\Authentication\AuthenticationInterface;

class LogoutUser
{
    public function __construct(
        private AuthenticationInterface $authenticationAdapter
    ) {
    }

    public function handle()
    {
        $this->authenticationAdapter->logout();
    }
}
