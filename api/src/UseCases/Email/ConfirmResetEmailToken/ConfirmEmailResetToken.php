<?php

namespace Src\UseCases\Email\ConfirmResetEmailToken;

use Src\Adapters\Repositories\EmailResetTokenRepository\EmailResetTokenRepositoryInterface;

class ConfirmEmailResetToken
{
    public function __construct(
        private EmailResetTokenRepositoryInterface $repository
    ) {

    }

    public function handle(ConfirmEmailResetTokenInput $input): ConfirmEmailResetTokenOutput
    {
        $isValid = $this->repository->markMasOpened($input->token);

        return new ConfirmPasswordResetTokenOutput(
            $isValid
        );
    }
}
