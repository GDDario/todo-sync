<?php

namespace Src\Domain\Entities\Preferences;

use Src\Domain\ValueObjects\Uuid;

class FontFactor
{
    public function __construct(
        public int        $id,
        public Uuid       $uuid,
        public string|int $value,
    )
    {
    }

    public static function createFromModel($model): FontFactor
    {
        return new self(
            id: $model->id,
            uuid: new Uuid($model->uuid),
            value: $model->value,
        );
    }
}
