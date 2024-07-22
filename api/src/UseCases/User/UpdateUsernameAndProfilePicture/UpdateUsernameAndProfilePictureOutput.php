<?php

namespace Src\UseCases\User\UpdateUsernameAndProfilePicture;

use Src\Domain\Entities\User;

class UpdateUsernameAndProfilePictureOutput
{
    public function __construct(
        public User $user
    ) {

    }
}
