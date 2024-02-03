<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Src\Adapters\Presenters\LoginPresenter;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\LoginUser\LoginUser;
use Src\UseCases\LoginUser\LoginUserInput;

class LoginController extends Controller
{
    public function store(LoginRequest $request, LoginUser $useCase)
    {
        $data = $useCase->handle(
            new LoginUserInput(
                email: $request->email,
                password: $request->password,
            )
        );

        return new LoginPresenter($data);
    }
}
