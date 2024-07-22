<?php

namespace Src\UseCases\Email\SendUpdateEmail;

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
