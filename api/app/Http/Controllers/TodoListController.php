<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoListRequest;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\TodoListPresenter;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\TodoList\CreateTodoList\CreateTodoList;
use Src\UseCases\TodoList\CreateTodoList\CreateTodoListInput;
use Src\UseCases\TodoList\ShowTodoList\ShowTodoList;
use Src\UseCases\TodoList\ShowTodoList\ShowTodoListInput;
use Src\UseCases\TodoList\TodoListLister\TodoListLister;
use Src\UseCases\TodoList\TodoListLister\TodoListListerInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;

class TodoListController extends Controller
{
    public function __construct(
        private GetUserByToken $userUseCase
    )
    {
    }

    public function index(Request $request, TodoListLister $useCase): array
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

    public function show(Request $request, ShowTodoList $useCase): TodoListPresenter
    {
        $response = $useCase->handle(
            new ShowTodoListInput(
                new Uuid($request->route('uuid'))
            )
        );

        return new TodoListPresenter($response);
    }

    public function store(CreateTodoListRequest $request, CreateTodoList $useCase): TodoListPresenter
    {
        $userData = $this->userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new CreateTodoListInput(
                userId: $userData->id,
                name: $request->input('name'),
                isCollaborative: $request->input('is_collaborative'),
                collaboratorsUuids: $request->input('collaborators_uuids')
            )
        );

        return new TodoListPresenter($response);
    }
}
