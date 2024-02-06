<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginPresenter extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => [
                'uuid' => is_object($this->uuid) ? $this->uuid->__toString() : $this->uuid,
                'username' => $this->username,
                'email' => is_object($this->email) ? $this->email->__toString() : $this->email,
            ],
            'token' => $this->token
        ];;
    }
}
