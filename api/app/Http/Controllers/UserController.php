<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUsernameAndPictureRequest;
use Illuminate\Http\Request;
use Log;
use Src\Adapters\Presenters\UserPresenter;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;
use Src\UseCases\User\GetUserByEmail\GetUserByEmail;
use Src\UseCases\User\GetUserByEmail\GetUserByEmailInput;
use Src\UseCases\User\UpdateUsernameAndProfilePicture\UpdateUsernameAndProfilePicture;
use Src\UseCases\User\UpdateUsernameAndProfilePicture\UpdateUsernameAndProfilePictureInput;

class UserController extends Controller
{
    public function getByToken(Request $request, GetUserByToken $useCase)
    {
        $data = $useCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        return new UserPresenter($data);
    }

    public function getByEmail(Request $request, GetUserByEmail $useCase)
    {
        $data = $useCase->handle(
            new GetUserByEmailInput($request->get('value', '') ?? '')
        );

        return new UserPresenter($data->user);
    }

    public function update(UpdateUsernameAndPictureRequest $request, UpdateUsernameAndProfilePicture $useCase, GetUserByToken $userUseCase)
    {
        $userData = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new UpdateUsernameAndProfilePictureInput(
                $userData->id,
                $request->username,
                $request->file('profile_picture')
            )
        );

        return new UserPresenter($response->user);
    }
}
