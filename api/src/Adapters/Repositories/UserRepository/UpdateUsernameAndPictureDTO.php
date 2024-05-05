<?php

namespace Src\Adapters\Repositories\UserRepository;

class UpdateUsernameAndPictureDTO
{
    public function __construct(
        public int $userId,
        public string $username,
        public ?string $picturePath = null
    )
    {
    }
}
