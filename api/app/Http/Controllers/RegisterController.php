<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\RegisterUser\RegisterUser;
use Src\UseCases\RegisterUser\RegisterUserInput;

class RegisterController extends Controller
{
    public function login(RegisterRequest $request, RegisterUser $useCase)
    {
        $data = $useCase->handle(
            new RegisterUserInput(
                username: $request->username,
                email: $request->email,
                password: $request->password,
                confirmPassword: $request->password_confirmation
            )
        );

        return new UserPresenter($data);
    }
}
