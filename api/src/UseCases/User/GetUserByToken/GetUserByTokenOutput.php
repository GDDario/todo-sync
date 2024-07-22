<?php

namespace Src\UseCases\User\GetUserByToken;

use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class GetUserByTokenOutput
{
    public function __construct(
        public int $id,
        public Uuid $uuid,
        public string $username,
        public Email $email,
        public ?string $picturePath = null,
    ) {
    }
}
