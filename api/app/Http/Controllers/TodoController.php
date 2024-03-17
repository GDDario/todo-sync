<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTodoTitleRequest;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\TodosPresenter;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\Todo\UpdateTodoTitle\UpdateTodoTitle;
use Src\UseCases\Todo\UpdateTodoTitle\UpdateTodoTitleInput;
use Src\UseCases\Todo\GetTodosByTodoListUuid\GetTodosByTodoListUuid;
use Src\UseCases\Todo\GetTodosByTodoListUuid\GetTodosByTodoListUuidInput;
use Src\UseCases\Todo\ToggleTodoState\ToggleTodoState;
use Src\UseCases\Todo\ToggleTodoState\ToggleTodoStateInput;

class TodoController extends Controller
{
    public function index(Request $request, GetTodosByTodoListUuid $useCase): TodosPresenter
    {
        $response = $useCase->handle(new GetTodosByTodoListUuidInput(
            new Uuid($request->route('todoListUuid'))
        ));

        return new TodosPresenter($response);
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
