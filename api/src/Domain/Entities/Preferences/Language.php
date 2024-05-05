<?php

namespace Src\Domain\Entities\Preferences;

use Src\Domain\ValueObjects\Uuid;

class Language
{
    public function __construct(
        public int    $id,
        public Uuid   $uuid,
        public string $name,
        public string $tag,
    )
    {
    }

    public static function createFromModel($model): Language
    {
        return new self(
            id: $model->id,
            uuid: new Uuid($model->uuid),
            name: $model->name,
            tag: $model->tag,
        );
    }
}
