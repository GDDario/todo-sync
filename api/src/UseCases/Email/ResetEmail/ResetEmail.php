<?php

namespace Src\UseCases\Email\ResetEmail;

use Carbon\Carbon;
use Exception;
use Src\Adapters\Repositories\EmailResetTokenRepository\EmailResetTokenRepositoryInterface;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;
use Src\Domain\Exceptions\EntityNotFoundException;

class ResetEmail
{
    public function __construct(
        private EmailResetTokenRepositoryInterface $emailResetTokenRepository,
        private UserRepositoryInterface            $userRepository
    )
    {

    }

    public function handle(ResetEmailInput $input)
    {
        $data = $this->emailResetTokenRepository->findByToken($input->token);

        $createdAtCarbon = Carbon::parse($data->createdAt);
        $now = Carbon::now();

        if ($createdAtCarbon->diffInHours($now) >= 1) {
            $this->emailResetTokenRepository->deleteByUserId($data->user_id);
            throw new Exception('This token was expired!');
        }

        if (!$data->opened) {
            throw new Exception('Email was not opened correctly, something went wrong.');
        }

        if ($input->newEmail !== $input->newEmailConfirmation) {
            throw new Exception('The email do not match the confirmation.');
        }

        $this->userRepository->updateEmailByUserId($data->user_id, $input->newEmail);
        $this->emailResetTokenRepository->deleteByUserId($data->user_id);
    }
}
