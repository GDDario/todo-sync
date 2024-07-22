<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoListPresenter extends JsonResource
{
    public function toArray($request): array
    {
        $array = [
            'uuid' => is_object($this->uuid) ? $this->uuid->__toString() : $this->uuid,
            'name' => $this->name,
            'is_collaborative' => $this->isCollaborative,
            'created_at' => $this->createdAt ?? null,
            'updated_at' => $this->updatedAt ?? null
        ];

        return $array;
    }
}
