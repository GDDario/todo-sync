<?php

namespace Src\UseCases\Email\SendResetEmail;

class SendResetEmailInput
{
    public function __construct(
        public int $userId,
        public string $username,
        public string $email
    )
    {

    }
}
