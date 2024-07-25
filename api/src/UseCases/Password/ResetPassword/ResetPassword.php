<?php

namespace Src\UseCases\Password\ResetPassword;

use Carbon\Carbon;
use Exception;
use Src\Adapters\Repositories\PasswordRestTokenRepository\PasswordResetTokenRepositoryInterface;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;

class ResetPassword
{
    public function __construct(
        private PasswordResetTokenRepositoryInterface $passwordResetTokenRepository,
        private UserRepositoryInterface               $userRepository
    )
    {

    }

    public function handle(ResetPasswordInput $input)
    {
        $data = $this->passwordResetTokenRepository->findByToken($input->token);

        $createdAtCarbon = Carbon::parse($data->createdAt);
        $now = Carbon::now();

        if ($createdAtCarbon->diffInHours($now) >= 1) {
            $this->passwordResetTokenRepository->deleteByEmail($data->email);
            throw new Exception('This token was expired!');
        }

        if (!$data->opened) {
            throw new Exception('Email was not opened correctly, something went wrong.');
        }

        if ($input->newPassword !== $input->newPasswordConfirmation) {
            throw new Exception('The email do not match the confirmation.');
        }

        $this->userRepository->updatePasswordByEmail($data->email, $input->newPassword);
        $this->passwordResetTokenRepository->deleteByEmail($data->email);
    }
}
