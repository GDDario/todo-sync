<?php

namespace Src\UseCases\Todo\UpdateTodoTitle;

use Src\Domain\ValueObjects\Uuid;

class UpdateTodoTitleInput
{
    public function __construct(
        public Uuid   $uuid,
        public string $title
    )
    {
    }
}
