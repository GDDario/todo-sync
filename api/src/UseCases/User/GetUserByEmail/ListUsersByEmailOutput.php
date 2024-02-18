<?php

namespace Src\UseCases\User\GetUserByEmail;

use Src\Domain\Entities\User;

class GetUserByEmailOutput
{
    public function __construct(
        public User $user
    ) {
    }
}
