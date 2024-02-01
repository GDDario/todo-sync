<?php

namespace Src\UseCases\RegisterUser;

use DateTime;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class RegisterUserOutput
{
    public function __construct(
        public Uuid $uuid,
        public string $username,
        public Email $email,
        public DateTime $createdAt
    ) {
    }
}
