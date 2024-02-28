<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardPresenter extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'todos' => $this->todos,
            'commitments' => $this->commitments,
            'most_used_tags' => $this->mostUsedTags
        ];
    }
}
