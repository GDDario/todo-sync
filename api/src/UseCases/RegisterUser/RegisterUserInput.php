<?php

namespace Src\UseCases\RegisterUser;

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
