<?php

namespace Src\UseCases\Todo\GetTodoByUuid;

use Src\Domain\ValueObjects\Uuid;

class GetTodoByUuidInput
{
    public function __construct(
        public Uuid $uuid,
    )
    {
    }
}
