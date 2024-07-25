<?php

namespace Src\UseCases\Email\SendResetEmail;

use App\Mail\ResetEmailMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Src\Adapters\Repositories\EmailResetTokenRepository\EmailResetTokenRepositoryInterface;
use Src\Adapters\Repositories\EmailResetTokenRepository\ResetTokenDTO;

class SendResetEmail
{
    public function __construct(
        private EmailResetTokenRepositoryInterface $repository
    )
    {
    }

    public function handle(SendResetEmailInput $input): void
    {
        $this->repository->deleteByUserId($input->userId);

        $token = Str::random(255);
        $now = Carbon::now();
        $dto = new ResetTokenDTO(
            $input->userId,
            $token,
            $now
        );

        $this->repository->store($dto);

        Mail::to($input->email)->send(new ResetEmailMail(
            $input->username,
            $token
        ));
    }
}
