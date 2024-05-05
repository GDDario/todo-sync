<?php

namespace Src\Domain\Entities;

use DateTime;
use DateTimeInterface;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

class User
{
    public function __construct(
        public int $id,
        public Uuid $uuid,
        public string $username,
        public Email $email,
        public ?string $picturePath = null,
        public ?string $password = null,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $editedAt = null
    ) {
    }
}
