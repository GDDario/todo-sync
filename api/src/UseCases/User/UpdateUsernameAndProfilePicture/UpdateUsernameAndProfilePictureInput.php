<?php

namespace Src\UseCases\User\UpdateUsernameAndProfilePicture;

class UpdateUsernameAndProfilePictureInput
{
    public function __construct(
        public int $userId,
        public string $username,
        public bool $changingPicture,
        public mixed $profilePicture,
    )
    {
    }
}
