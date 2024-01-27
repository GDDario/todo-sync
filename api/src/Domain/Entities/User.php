<?php

namespace Src\Domain\Entities;

use DateTime;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class User
{
    public function __construct(
        public int $id,
        public string $name,
        public Email $email,
        public Uuid $uuid,
        public string $password,
        public ?DateTime $createdAt,
        public ?DateTime $editedAt
    ) {
    }
}
