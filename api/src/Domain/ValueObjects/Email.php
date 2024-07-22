<?php

namespace Src\Domain\ValueObjects;

use Src\Domain\Exceptions\InvalidValueObjectException;

class Email
{
    public function __construct(
        private string $value
    )
    {
        $this->validate();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function validate()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueObjectException('Invalid email.');
        }
    }
}
