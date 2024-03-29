<?php

namespace Src\Domain\ValueObjects;

use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Domain\Exceptions\InvalidValueObjectException;

class Uuid
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
        if (!Uuidv4::isValid($this->value)) {
            throw new InvalidValueObjectException('Invalid Uuid.');
        }
    }
}
