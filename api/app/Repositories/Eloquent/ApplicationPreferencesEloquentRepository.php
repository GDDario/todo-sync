<?php

namespace App\Repositories\Eloquent;

use App\Models\ApplicationPreferences;
use App\Models\FontFactor;
use App\Models\Language;
use App\Models\Theme;
use Src\Adapters\Repositories\PreferencesRepository\ApplicationPreferencesRepositoryInterface;
use Src\Adapters\Repositories\PreferencesRepository\UpdateApplicationPreferencesByUserIdDTO;
use Src\Domain\Entities\Preferences\ApplicationPreferences as ApplicationPreferencesEntity;
use Src\Domain\Entities\Preferences\FontFactor as FontFactorEntity;
use Src\Domain\Entities\Preferences\Language as LanguageEntity;
use Src\Domain\Entities\Preferences\Theme as ThemeEntity;
use Src\Domain\Exceptions\EntityNotFoundException;
use Src\Domain\ValueObjects\Uuid;

class ApplicationPreferencesEloquentRepository implements ApplicationPreferencesRepositoryInterface
{
    public function findAll(): array
    {
        $themes = Theme::all()->map(fn($theme) => ThemeEntity::createFromModel($theme))->toArray();
        $languages = Language::all()->map(fn($language) => LanguageEntity::createFromModel($language))->toArray();
        $fontFactors = FontFactor::all()->map(fn($fontFactor) => FontFactorEntity::createFromModel($fontFactor))->toArray();

        return [
            'themes' => $themes,
            'languages' => $languages,
            'fontFactors' => $fontFactors,
        ];
    }

    public function findByUserId(int $userId): ApplicationPreferencesEntity
    {
        $preferences = ApplicationPreferences::where('user_id', $userId)->first();

        return $this->hydrateEntity($preferences);
    }

    public function update(UpdateApplicationPreferencesByUserIdDTO $dto): ApplicationPreferencesEntity
    {
        if (!$theme = Theme::where('uuid', $dto->themeUuid)->first()) {
            throw new EntityNotFoundException("Theme with UUID '{$dto->themeUuid}' not found.");
        }
        if (!$language = Language::where('uuid', $dto->languageUuid)->first()) {
            throw new EntityNotFoundException("Language with UUID '{$dto->languageUuid}' not found.");

        }
        if (!$fontFactor = FontFactor::where('uuid', $dto->fontFactorUuid)->first()) {
            throw new EntityNotFoundException("Font factor with UUID '{$dto->fontFactorUuid}' not found.");
        }

        $preferences = ApplicationPreferences::where('user_id', $dto->userId)->first();

        $preferences->update([
            'theme_id' => $theme->id,
            'language_id' => $language->id,
            'font_factor_id' => $fontFactor->id,
        ]);
        $preferences->refresh();

        return $this->hydrateEntity($preferences);
    }

    private function hydrateEntity(ApplicationPreferences $preferences): ApplicationPreferencesEntity
    {
        return new ApplicationPreferencesEntity(
            id: $preferences->id,
            uuid: new Uuid($preferences->uuid),
            userId: $preferences->user_id,
            theme: ThemeEntity::createFromModel($preferences->theme),
            fontFactor: FontFactorEntity::createFromModel($preferences->fontFactor),
            language: LanguageEntity::createFromModel($preferences->language),
            createdAt: $preferences->created_at,
            updatedAt: $preferences->created_at
        );
    }
}
