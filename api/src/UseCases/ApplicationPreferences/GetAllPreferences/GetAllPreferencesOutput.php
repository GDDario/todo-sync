<?php

namespace Src\UseCases\ApplicationPreferences\GetAllPreferences;

class GetAllPreferencesOutput
{
    public function __construct(
        public array $preferences
    )
    {
    }
}
