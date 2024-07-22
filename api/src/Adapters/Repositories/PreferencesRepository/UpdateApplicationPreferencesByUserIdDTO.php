<?php

namespace Src\Adapters\Repositories\PreferencesRepository;

use Src\Domain\ValueObjects\Uuid;

class UpdateApplicationPreferencesByUserIdDTO
{
    public function __construct(
        public int $userId,
        public Uuid $themeUuid,
        public Uuid $languageUuid,
        public Uuid $fontFactorUuid
    ) {
    }
}
