<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;
use Src\UseCases\User\GetUserByEmail\GetUserByEmail;
use Src\UseCases\User\GetUserByEmail\GetUserByEmailInput;

class UserController extends Controller
{
    public function getByToken(Request $request, GetUserByToken $useCase)
    {
        $data = $useCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        return new UserPresenter($data);
    }

    public function listByEmail(Request $request, GetUserByEmail $useCase)
    {
        $data = $useCase->handle(
            new GetUserByEmailInput($request->get('value', ''))
        );

       return new UserPresenter($data);
    }
}
