<?php

namespace Src\Domain\Entities\Preferences;

use Src\Domain\ValueObjects\Uuid;

class Theme
{
    public function __construct(
        public int    $id,
        public Uuid   $uuid,
        public string $name,
        public string $primary,
        public string $primaryVariant,
        public string $secondary,
        public string $secondaryVariant,
        public string $accent,
        public string $accentVariant,
        public string $background,
        public string $backgroundVariant,
    )
    {
    }

    public static function createFromModel($model): Theme
    {
        return new self(
            id: $model->id,
            uuid: new Uuid($model->uuid),
            name: $model->name,
            primary: $model->primary,
            primaryVariant: $model->primary_variant,
            secondary: $model->secondary,
            secondaryVariant: $model->secondary_variant,
            accent: $model->accent,
            accentVariant: $model->accent_variant,
            background: $model->background,
            backgroundVariant: $model->background_variant,
        );
    }
}
