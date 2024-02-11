<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoListPresenter extends JsonResource
{
    public function toArray($request)
    {
        $array = [
            'uuid' => is_object($this->uuid) ? $this->uuid->__toString() : $this->uuid,
            'name' => $this->name,
            'is_collaborative' => $this->isCollaborative,
        ];

        if (isset($this->createdAt)) {
            $array['created_at'] =  $this->createdAt;
        }

        return $array;
    }
}
