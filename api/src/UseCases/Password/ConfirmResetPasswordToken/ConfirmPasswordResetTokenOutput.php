<?php

namespace Src\UseCases\Password\ConfirmResetPasswordToken;

class ConfirmPasswordResetTokenOutput
{
    public function __construct(
        public bool $isValid
    )
    {

    }
}
