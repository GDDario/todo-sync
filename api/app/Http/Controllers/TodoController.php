<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Requests\UpdateTodoTitleRequest;
use DateTime;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\TodoPresenter;
use Src\Adapters\Presenters\TodosPresenter;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\Todo\CreateTodo\CreateTodo;
use Src\UseCases\Todo\CreateTodo\CreateTodoInput;
use Src\UseCases\Todo\GetTodoByUuid\GetTodoByUuid;
use Src\UseCases\Todo\GetTodoByUuid\GetTodoByUuidInput;
use Src\UseCases\Todo\GetTodosByTodoListUuid\GetTodosByTodoListUuid;
use Src\UseCases\Todo\GetTodosByTodoListUuid\GetTodosByTodoListUuidInput;
use Src\UseCases\Todo\ToggleTodoState\ToggleTodoState;
use Src\UseCases\Todo\ToggleTodoState\ToggleTodoStateInput;
use Src\UseCases\Todo\UpdateTodo\UpdateTodo;
use Src\UseCases\Todo\UpdateTodo\UpdateTodoInput;
use Src\UseCases\Todo\UpdateTodoTitle\UpdateTodoTitle;
use Src\UseCases\Todo\UpdateTodoTitle\UpdateTodoTitleInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;

class TodoController extends Controller
{
    public function getByTodoList(Request $request, GetTodosByTodoListUuid $useCase): TodosPresenter
    {
        $response = $useCase->handle(new GetTodosByTodoListUuidInput(
            new Uuid($request->route('todoListUuid'))
        ));

        return new TodosPresenter($response);
    }

    public function get(Request $request, GetTodoByUuid $useCase): TodoPresenter
    {
        $response = $useCase->handle(
            new GetTodoByUuidInput(
                new Uuid($request->route('uuid'))
            )
        );

        return new TodoPresenter($response);
    }

    public function store(StoreTodoRequest $request, GetUserByToken $userUseCase, CreateTodo $useCase)
    {
        $user = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $todoGroupUuid = $request->input('todo_group_uuid');
        $todoGroupUuid = $todoGroupUuid ? new Uuid($todoGroupUuid) : null;

        $dueDate = $request->input('due_date') !== null ? new DateTime($request->input('due_date')) : null;

        $response = $useCase->handle(
            new CreateTodoInput(
                title: $request->input('title'),
                todoListUuid: new Uuid($request->input('todo_list_uuid')),
                userId: $user->id,
                tags: $request->input('tags', []),
                todoGroupUuid: $todoGroupUuid,
                description: $request->input('description'),
                dueDate: $dueDate,
                isUrgent: $request->input('is_urgent'),
                scheduleOptions: $request->input('schedule_options')
            )
        );

        return response(new TodoPresenter($response), 201);
    }

    public function update(UpdateTodoRequest $request, GetUserByToken $userUseCase, UpdateTodo $useCase)
    {
        $user = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $todoGroupUuid = $request->input('todo_group_uuid');
        $todoGroupUuid = $todoGroupUuid ? new Uuid($todoGroupUuid) : null;

        $dueDate = $request->input('due_date') !== null ? new DateTime($request->input('due_date')) : null;

        $response = $useCase->handle(
            new UpdateTodoInput(
                uuid: new Uuid($request->route('uuid')),
                title: $request->input('title'),
                todoListUuid: new Uuid($request->input('todo_list_uuid')),
                userId: $user->id,
                tags: $request->input('tags', []),
                todoGroupUuid: $todoGroupUuid,
                description: $request->input('description'),
                dueDate: $dueDate,
                isUrgent: $request->input('is_urgent'),
                scheduleOptions: $request->input('schedule_options')
            )
        );

        return new TodoPresenter($response);
    }

    public function toggleState(Request $request, ToggleTodoState $useCase)
    {
        $response = $useCase->handle(
            new ToggleTodoStateInput(
                new Uuid($request->route('uuid'))
            )
        );

        return response(['data' => ['is_completed' => $response->newState]], 200);
    }

    public function changeTitle(UpdateTodoTitleRequest $request, UpdateTodoTitle $useCase)
    {
        $useCase->handle(
            new UpdateTodoTitleInput(
                new Uuid($request->route('uuid')),
                $request->input('title')
            )
        );
    }
}
