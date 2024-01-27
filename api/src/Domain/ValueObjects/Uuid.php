<?php

namespace Src\Domain\ValueObjects;

use Ramsey\Uuid\Uuid as Uuidv4;
use Src\Domain\Exception\InvalidValueObjectException;

class Uuid
{
    public function __construct(
        private string $value
    )
    {
        $this->validate();
    }

    private function validate()
    {
        if (!Uuidv4::isValid($this->value)) {
            throw new InvalidValueObjectException('Invalid Uuid.');
        }
    }
}
