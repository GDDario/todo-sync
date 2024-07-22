<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Adapters\Presenters\TagsPresenter;
use Src\UseCases\Tag\GetUserTags\GetUserTags;
use Src\UseCases\Tag\GetUserTags\GetUserTagsInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;

class TagController extends Controller
{
    public function index(Request $request, GetUserTags $useCase, GetUserByToken $userUseCase)
    {
        $user = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new GetUserTagsInput(
                $user->id
            )
        );

        return new TagsPresenter($response);
    }
}
