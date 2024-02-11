<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoListRequest;
use Src\Adapters\Presenters\TodoListPresenter;
use Src\UseCases\TodoList\CreateTodoList;
use Src\UseCases\TodoList\CreateTodoListInput;
use Src\UseCases\User\GetUserFromToken\GetUserFromToken;
use Src\UseCases\User\GetUserFromToken\GetUserFromTokenInput;

class TodoListController extends Controller
{
    public function store(CreateTodoListRequest $request, CreateTodoList $useCase, GetUserFromToken $userUseCase) {
        $userData = $userUseCase->handle(
            new GetUserFromTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new CreateTodoListInput(
                userId: $userData->id,
                name: $request->name,
                isCollaborative: $request->is_collaborative
            )
        );

        return new TodoListPresenter($response);
    }
}
