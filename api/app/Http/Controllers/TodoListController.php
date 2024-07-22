<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePositionsRequest;
use App\Http\Requests\CreateTodoListRequest;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\TodoListPresenter;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\TodoList\ChangePositions\ChangePositions;
use Src\UseCases\TodoList\ChangePositions\ChangePositionsInput;
use Src\UseCases\TodoList\CreateTodoList\CreateTodoList;
use Src\UseCases\TodoList\CreateTodoList\CreateTodoListInput;
use Src\UseCases\TodoList\ShowTodoList\ShowTodoList;
use Src\UseCases\TodoList\ShowTodoList\ShowTodoListInput;
use Src\UseCases\TodoList\TodoListLister\TodoListLister;
use Src\UseCases\TodoList\TodoListLister\TodoListListerInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;
use Symfony\Component\HttpFoundation\Response;

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

    public function changePositions(ChangePositionsRequest $request, ChangePositions $useCase)
    {
        $useCase->handle(
            new ChangePositionsInput(
                todoListUuid: new Uuid($request->route('uuid')),
                positions: $request->input('positions')
            )
        );

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
