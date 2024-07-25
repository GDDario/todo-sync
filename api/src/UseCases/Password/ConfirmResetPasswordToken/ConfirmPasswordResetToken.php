<?php

namespace Src\UseCases\Password\ConfirmResetPasswordToken;

use Src\Adapters\Repositories\PasswordRestTokenRepository\PasswordResetTokenRepositoryInterface;

class ConfirmPasswordResetToken
{
    public function __construct(
        private PasswordResetTokenRepositoryInterface $repository
    ) {

    }

    public function handle(ConfirmPasswordResetTokenInput $input): ConfirmPasswordResetTokenOutput
    {
        $isValid = $this->repository->markMasOpened($input->token);

        return new ConfirmPasswordResetTokenOutput(
            $isValid
        );
    }
}
