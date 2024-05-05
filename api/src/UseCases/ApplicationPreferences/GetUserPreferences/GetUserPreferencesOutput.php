<?php

namespace Src\UseCases\ApplicationPreferences\GetUserPreferences;

use Src\Domain\Entities\Preferences\ApplicationPreferences;

class GetUserPreferencesOutput
{
    public function __construct(
        public ApplicationPreferences $preferences
    )
    {
    }
}
