<?php

namespace Src\Adapters\Repositories\PasswordRestTokenRepository;

use DateTimeInterface;

class ResetTokenDTO
{
    public function __construct(
        public string $email,
        public $token,
        public DateTimeInterface $createdAt
    )
    {

    }
}
