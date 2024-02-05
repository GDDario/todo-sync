<?php

namespace Src\Adapters\Authentication;

use Src\UseCases\LoginUser\LoginUserInput;

interface AuthenticationInterface
{
    public function login(array $credentials);
    public function logout();
}
