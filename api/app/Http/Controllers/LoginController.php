<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\LoginPresenter;
use Src\UseCases\User\LoginUser\LoginUser;
use Src\UseCases\User\LoginUser\LoginUserInput;
use Src\UseCases\User\LogoutUser\LogoutUser;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginUser $useCase)
    {
        $data = $useCase->handle(
            new LoginUserInput(
                email: $request->input('email'),
                password: $request->input('password'),
            )
        );

        return new LoginPresenter($data);
    }

    public function logout(Request $request, LogoutUser $useCase) {
        $useCase->handle();
    }
}
