<?php

namespace Src\UseCases\User\RegisterUser;

class RegisterUserInput
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
        public string $confirmPassword
    ) {
    }
}
