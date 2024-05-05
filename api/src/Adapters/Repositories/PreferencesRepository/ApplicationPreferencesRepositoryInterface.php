<?php

namespace Src\Adapters\Repositories\PreferencesRepository;

use Src\Domain\Entities\Preferences\ApplicationPreferences;

interface ApplicationPreferencesRepositoryInterface
{
    public function findAll(): array;

    public function findByUserId(int $userId): ApplicationPreferences;

    public function update(UpdateApplicationPreferencesByUserIdDTO $dto): ApplicationPreferences;
}
