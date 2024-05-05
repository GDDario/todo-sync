<?php

namespace Src\UseCases\ApplicationPreferences\UpdateUserPreferences;

use Src\Domain\Entities\Preferences\ApplicationPreferences;

class UpdateUserPreferencesOutput
{
    public function __construct(
        public ApplicationPreferences $preferences
    )
    {
    }
}
