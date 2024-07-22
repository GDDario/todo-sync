<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPresenter extends JsonResource
{
    public function toArray($request): array
    {
        $array = [
            'uuid' => is_object($this->uuid) ? $this->uuid->__toString() : $this->uuid,
            'username' => $this->username,
            'email' => is_object($this->email) ? $this->email->__toString() : $this->email,
            'picture_path' => $this->picturePath,
        ];

        if (isset($this->createdAt)) {
            $array['created_at'] = $this->createdAt;
        }

        if (isset($this->updatedAt)) {
            $array['updated_at'] = $this->updatedAt;
        }

        return $array;
    }
}
