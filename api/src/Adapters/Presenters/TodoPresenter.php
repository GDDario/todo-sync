<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoPresenter extends JsonResource
{
    public function toArray($request): array
    {
        $tags = array_map(fn($tag) => $this->mapTagToJson($tag), $this->tags);

        $data =  [
            'uuid' => $this->uuid->__toString(),
            'title' => $this->title,
            'is_urgent' => $this->isUrgent,
            'due_date' => $this->dueDate,
            'is_completed' => $this->isCompleted,
            'description' => $this->description,
            'schedule_options' => $this->scheduleOptions,
            'tags' => $tags
        ];

        if (isset($this->todoGroupUuid)) {
            $data['todo_group_uuid'] = $this->todoGroupUuid->__toString();
        }

        return $data;
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
