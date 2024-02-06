<?php

namespace Src\UseCases\User\GetUserFromToken;

use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class GetUserFromTokenOutput
{
    public function __construct(
        public Uuid $uuid,
        public string $username,
        public Email $email,
    ) {
    }
}
