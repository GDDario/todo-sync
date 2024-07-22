<?php

namespace Src\Adapters\Repositories\UserRepository;

use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class RegisterUserDTO
{
    public function __construct(
        public Uuid $uuid,
        public string $username,
        public Email $email,
        public string $password
    ) {
    }
}
