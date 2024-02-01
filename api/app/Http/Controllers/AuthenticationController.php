<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\RegisterUser\RegisterUser;
use Src\UseCases\RegisterUser\RegisterUserInput;

class AuthenticationController extends Controller
{
    public function store(RegisterRequest $request, RegisterUser $useCase)
    {
        $response = $useCase->handle(
            new RegisterUserInput(
                username: $request->username,
                email: $request->email,
                password: $request->password,
                confirmPassword: $request->password_confirmation
            )
        );

        return new UserPresenter($response);
    }
}
