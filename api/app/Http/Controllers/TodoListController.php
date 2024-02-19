<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoListRequest;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\TodoListPresenter;
use Src\UseCases\TodoList\CreateTodoList\CreateTodoList;
use Src\UseCases\TodoList\CreateTodoList\CreateTodoListInput;
use Src\UseCases\TodoList\TodoListLister\TodoListLister;
use Src\UseCases\TodoList\TodoListLister\TodoListListerInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;

class TodoListController extends Controller
{
    public function __construct(
        private GetUserByToken $userUseCase
    ) {
    }

    public function store(CreateTodoListRequest $request, CreateTodoList $useCase)
    {
        $userData = $this->userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new CreateTodoListInput(
                userId: $userData->id,
                name: $request->name,
                isCollaborative: $request->is_collaborative,
                collaboratorsUuids: $request->collaborators_uuids
            )
        );

        return new TodoListPresenter($response);
    }

    public function listByUserId(Request $request, TodoListLister $useCase)
    {
        $userData = $this->userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new TodoListListerInput($userData->id)
        );

        $todoListsPresenter = array_map(function ($todoList) {
            return new TodoListPresenter($todoList);
        }, $response->todoLists);

        return ['data' => $todoListsPresenter];
    }
}
