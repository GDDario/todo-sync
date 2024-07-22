<?php

namespace Src\Adapters\Repositories\EmailResetTokenRepository;

use DateTimeInterface;

class ResetTokenDTO
{
    public function __construct(
        public int $userId,
        public $token,
        public DateTimeInterface $createdAt
    )
    {
    }
}
