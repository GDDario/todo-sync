<?php

namespace Src\UseCases\Password\SendPasswordResetEmail;

use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Src\Adapters\Repositories\PasswordRestTokenRepository\PasswordResetTokenRepositoryInterface;
use Src\Adapters\Repositories\PasswordRestTokenRepository\ResetTokenDTO;

class SendPasswordResetEmail
{
    public function __construct(
        private PasswordResetTokenRepositoryInterface $repository
    )
    {

    }

    public function handle(SendPasswordResetEmailInput $input)
    {
        $this->repository->deleteByEmail($input->email);

        $token = Str::random(255);
        $now = Carbon::now();
        $dto = new ResetTokenDTO(
            $input->email,
            $token,
            $now
        );

        $this->repository->store($dto);

        Mail::to($input->email)->send(new ResetPasswordMail(
            $input->username,
            $token
        ));
    }
}
