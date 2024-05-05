<?php

namespace Src\UseCases\ApplicationPreferences\UpdateUserPreferences;

use Src\Domain\ValueObjects\Uuid;

class UpdateUserPreferencesInput
{
    public function __construct(
        public Uuid $themeUuid,
        public Uuid $languageUuid,
        public Uuid $fontFactorUuid,
        public int $userId
    )
    {
    }
}
