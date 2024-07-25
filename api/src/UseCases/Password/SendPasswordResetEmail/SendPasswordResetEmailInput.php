<?php

namespace Src\UseCases\Password\SendPasswordResetEmail;

class SendPasswordResetEmailInput
{
    public function __construct(
        public string $username,
        public string $email
    )
    {

    }
}
