<?php

namespace Src\UseCases\Password\ResetPassword;

class ResetPasswordInput
{
    public function __construct(
        public string $newPassword,
        public string $newPasswordConfirmation,
        public string $token
    )
    {

    }
}
