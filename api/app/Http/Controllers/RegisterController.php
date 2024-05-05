<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\User\RegisterUser\RegisterUser;
use Src\UseCases\User\RegisterUser\RegisterUserInput;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request, RegisterUser $useCase)
    {


        $data = $useCase->handle(
            new RegisterUserInput(
                username: $request->input('username'),
                email: $request->input('email'),
                password: $request->input('password'),
                confirmPassword: $request->input('password_confirmation')
            )
        );

        return new UserPresenter($data);
    }
}
