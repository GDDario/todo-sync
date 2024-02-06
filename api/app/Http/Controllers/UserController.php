<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\User\GetUserFromToken\GetUserFromToken;
use Src\UseCases\User\GetUserFromToken\GetUserFromTokenInput;

class UserController extends Controller
{
    public function getByToken(Request $request, GetUserFromToken $useCase)
    {
        $data = $useCase->handle(
            new GetUserFromTokenInput($request->bearerToken())
        );

        return new UserPresenter($data);
    }
}
