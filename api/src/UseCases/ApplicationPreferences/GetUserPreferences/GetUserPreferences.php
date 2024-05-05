<?php

namespace Src\UseCases\ApplicationPreferences\GetUserPreferences;

use Src\Adapters\Repositories\PreferencesRepository\ApplicationPreferencesRepositoryInterface;

class GetUserPreferences
{
    public function __construct(
        private ApplicationPreferencesRepositoryInterface $repository
    )
    {
    }

    public function handle(GetUserPreferencesInput $input): GetUserPreferencesOutput
    {
        $preferences = $this->repository->findByUserId($input->userId);

        return new GetUserPreferencesOutput(
            $preferences
        );
    }
}
