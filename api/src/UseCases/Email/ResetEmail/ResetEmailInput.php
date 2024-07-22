<?php

namespace Src\UseCases\Email\ResetEmail;

class ResetEmailInput
{
    public function __construct(
        public string $newEmail,
        public string $newEmailConfirmation,
        public string $token
    )
    {

    }
}
