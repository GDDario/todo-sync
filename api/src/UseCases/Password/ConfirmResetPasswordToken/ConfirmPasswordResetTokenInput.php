<?php

namespace Src\UseCases\Password\ConfirmResetPasswordToken;

class ConfirmPasswordResetTokenInput
{
    public function __construct(
        public string $token
    )
    {

    }
}
