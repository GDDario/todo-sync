<?php

namespace Src\UseCases\User\LoginUser;

use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class LoginUserOutput
{
    public function __construct(
        public Uuid $uuid,
        public string $username,
        public Email $email,
        public string $token
    ) {

    }
}
