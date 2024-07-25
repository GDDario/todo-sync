<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmEmailResetTokenRequest;
use App\Http\Requests\ConfirmPasswordResetTokenRequest;
use App\Http\Requests\ResetEmailRequest;
use Illuminate\Http\Request;
use Src\UseCases\Email\ConfirmResetEmailToken\ConfirmEmailResetToken;
use Src\UseCases\Email\ConfirmResetEmailToken\ConfirmEmailResetTokenInput;
use Src\UseCases\Email\ConfirmResetEmailToken\ConfirmPasswordResetToken;
use Src\UseCases\Email\ConfirmResetEmailToken\ConfirmPasswordResetTokenInput;
use Src\UseCases\Email\GenerateResetEmailToken\GenerateResetEmailToken;
use Src\UseCases\Email\GenerateResetEmailToken\GenerateResetEmailTokenInput;
use Src\UseCases\Email\ResetEmail\ResetEmail;
use Src\UseCases\Email\ResetEmail\ResetPasswordInput;
use Src\UseCases\Email\SendResetEmail\SendResetEmail;
use Src\UseCases\Email\SendResetEmail\SendResetEmailInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends Controller
{
    public function sendResetEmail(
        Request                 $request,
        SendResetEmail          $useCase,
        GetUserByToken          $userUseCase
    ): Response
    {
        $userData = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $useCase->handle(
            new SendResetEmailInput(
                $userData->id,
                $userData->username,
                $userData->email,
            )
        );

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function resetEmail(
        ResetEmailRequest $request,
        ResetEmail $useCase
    )
    {
        $useCase->handle(
            new ResetPasswordInput(
                $request->new_email,
                $request->new_email_confirmation,
                $request->token,
            )
        );

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function confirmToken(
        ConfirmEmailResetTokenRequest $request,
        ConfirmEmailResetToken $useCase
    )
    {
        $response = $useCase->handle(
            new ConfirmEmailResetTokenInput(
                $request->token,
            )
        );

        if ($response->isValid) {
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            return response(['message' => 'Invalid or already used token'], Response::HTTP_BAD_REQUEST);
        }
    }
}
