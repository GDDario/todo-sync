<?php

namespace Src\UseCases\User\LoginUser;

class LoginUserInput
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
