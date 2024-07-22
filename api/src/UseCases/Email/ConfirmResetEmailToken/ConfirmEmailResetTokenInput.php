<?php

namespace Src\UseCases\Email\ConfirmResetEmailToken;

class ConfirmEmailResetTokenInput
{
    public function __construct(
        public string $token
    )
    {

    }
}
