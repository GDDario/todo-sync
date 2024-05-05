<?php

namespace Src\UseCases\ApplicationPreferences\GetUserPreferences;

class GetUserPreferencesInput
{
    public function __construct(
        public int $userId
    )
    {
    }
}
