<?php

namespace Src\UseCases\LoginUser;

class LoginUserInput
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
