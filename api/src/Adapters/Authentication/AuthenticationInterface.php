<?php

namespace Src\Adapters\Authentication;

use Src\UseCases\User\GetUserByToken\GetUserByTokenOutput;
use Src\UseCases\User\LoginUser\LoginUserOutput;

interface AuthenticationInterface
{
    public function login(array $credentials): LoginUserOutput;
    public function logout();
    public function extractCredentialsFromToken(string $token): GetUserByTokenOutput;
}
