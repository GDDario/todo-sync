<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;
use Src\UseCases\User\ListUsersByEmail\ListUsersByEmail;
use Src\UseCases\User\ListUsersByEmail\ListUsersByEmailInput;

class UserController extends Controller
{
    public function getByToken(Request $request, GetUserByToken $useCase)
    {
        $data = $useCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        return new UserPresenter($data);
    }

    public function listByEmail(Request $request, ListUsersByEmail $useCase)
    {
        $data = $useCase->handle(
            new ListUsersByEmailInput($request->get('value', ''))
        );

        $mappedUsers = array_map(function($data) {
            return new UserPresenter($data);
        }, $data->users);

        return ['data' => $mappedUsers];
    }
}
