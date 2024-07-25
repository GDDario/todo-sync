<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmPasswordResetTokenRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Src\UseCases\Password\ConfirmResetPasswordToken\ConfirmPasswordResetToken;
use Src\UseCases\Password\ConfirmResetPasswordToken\ConfirmPasswordResetTokenInput;
use Src\UseCases\Password\ResetPassword\ResetPassword;
use Src\UseCases\Password\ResetPassword\ResetPasswordInput;
use Src\UseCases\Password\SendPasswordResetEmail\SendPasswordResetEmail;
use Src\UseCases\Password\SendPasswordResetEmail\SendPasswordResetEmailInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
   public function sendResetEmail(
       Request                 $request,
       SendPasswordResetEmail $useCase,
       GetUserByToken          $userUseCase
   ) {
       $userData = $userUseCase->handle(
           new GetUserByTokenInput($request->bearerToken())
       );

       $useCase->handle(
           new SendPasswordResetEmailInput(
               $userData->username,
               $userData->email
           )
       );

       return response(null, Response::HTTP_NO_CONTENT);
   }

    public function resetPassword(
        ResetPasswordRequest $request,
        ResetPassword $useCase
    )
    {
        $useCase->handle(
            new ResetPasswordInput(
                $request->new_password,
                $request->new_password_confirmation,
                $request->token,
            )
        );

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function confirmToken(
        ConfirmPasswordResetTokenRequest $request,
        ConfirmPasswordResetToken $useCase
    )
    {
        $response = $useCase->handle(
            new ConfirmPasswordResetTokenInput(
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
