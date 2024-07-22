<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;
use Src\Domain\Entities\Tag;

class TagsPresenter extends JsonResource
{
    public function toArray($request): array
    {
        return array_map(fn(Tag $tag) => [
            'uuid' => $tag->uuid->__toString(),
            'name' => $tag->name,
            'color' => $tag->color
        ], $this->tags);
    }
}
