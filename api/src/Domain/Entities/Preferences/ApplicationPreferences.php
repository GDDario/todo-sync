<?php

namespace Src\Domain\Entities\Preferences;

use DateTimeInterface;
use Src\Domain\ValueObjects\Uuid;

class ApplicationPreferences
{
    public function __construct(
        public int                $id,
        public Uuid               $uuid,
        public int                $userId,
        public Theme              $theme,
        public FontFactor         $fontFactor,
        public Language           $language,
        public ?DateTimeInterface $createdAt = null,
        public ?DateTimeInterface $updatedAt = null
    )
    {
    }
}
