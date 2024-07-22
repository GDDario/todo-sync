<?php

namespace Src\Domain\Entities;

use Src\Domain\ValueObjects\Uuid;

class Tag
{
    public function __construct(
        public int    $id,
        public Uuid   $uuid,
        public string $name,
        public string $color = '#0C88A4',
        public ?int   $userId = null
    )
    {
    }

    public static function createFromModel($model): Tag
    {
        return new self(
            id: $model->id,
            uuid: new Uuid($model->uuid),
            name: $model->name,
            color: $model->color,
        );
    }
}
