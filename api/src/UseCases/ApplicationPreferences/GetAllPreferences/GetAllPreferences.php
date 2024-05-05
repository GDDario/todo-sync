<?php

namespace Src\UseCases\ApplicationPreferences\GetAllPreferences;

use Src\Adapters\Repositories\PreferencesRepository\ApplicationPreferencesRepositoryInterface;

class GetAllPreferences
{
    public function __construct(
        private ApplicationPreferencesRepositoryInterface $repository
    )
    {
    }

    public function handle(): GetAllPreferencesOutput
    {
        $preferences = $this->repository->findAll();

        return new GetAllPreferencesOutput(
            $preferences
        );
    }
}
