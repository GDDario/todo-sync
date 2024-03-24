<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class TodosPresenter extends JsonResource
{
    public function toArray($request): array
    {
        $array['groups'] = array_map(fn($todo) => $this->mapTodoGroupToJson($todo), $this->todoGroups);
        $array['ungrouped_todos'] = array_map(fn($todo) => $this->mapTodoToJson($todo), $this->ungroupedTodos);
        $array['positions'] = json_decode($this->positions);

        return $array;
    }

    private function mapTodoGroupToJson($group): array
    {
        $todos = array_map(fn($todo) => $this->mapTodoToJson($todo), $group->todos);

        return [
            'uuid' => $group->uuid->__toString(),
            'name' => $group->name,
            'todos' => $todos
        ];
    }

    private function mapTodoToJson($todo): array
    {
        $tags = array_map(fn($tag) => $this->mapTagToJson($tag), $todo->tags);

        return [
            'uuid' => $todo->uuid->__toString(),
            'title' => $todo->title,
            'is_urgent' => $todo->isUrgent,
            'due_date' => $todo->dueDate,
            'is_completed' => $todo->isCompleted,
            'schedule_options' => $todo->scheduleOptions,
            'tags' => $tags
        ];
    }

    private function mapTagToJson($tag): array
    {
        return [
            'uuid' => $tag->uuid->__toString(),
            'name' => $tag->name,
            'color' => $tag->color,
        ];
    }
}
