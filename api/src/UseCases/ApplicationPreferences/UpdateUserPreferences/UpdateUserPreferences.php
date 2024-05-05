<?php

namespace Src\UseCases\ApplicationPreferences\UpdateUserPreferences;

use Src\Adapters\Repositories\PreferencesRepository\ApplicationPreferencesRepositoryInterface;
use Src\Adapters\Repositories\PreferencesRepository\UpdateApplicationPreferencesByUserIdDTO;

class UpdateUserPreferences
{
    public function __construct(
        private ApplicationPreferencesRepositoryInterface $repository
    )
    {
    }

    public function handle(UpdateUserPreferencesInput $input): UpdateUserPreferencesOutput
    {
        $dto = new UpdateApplicationPreferencesByUserIdDTO(
            userId: $input->userId,
            themeUuid: $input->themeUuid,
            languageUuid: $input->languageUuid,
            fontFactorUuid: $input->fontFactorUuid
        );

        $response = $this->repository->update($dto);

        return new UpdateUserPreferencesOutput(
            $response
        );
    }
}
