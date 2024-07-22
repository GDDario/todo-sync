<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class PreferencesPresenter extends JsonResource
{
    public function toArray($request): array
    {
        $data = [
            'uuid' => $this->uuid->__toString(),
            'theme' => $this->mapThemeToJson($this->theme),
            'language' => $this->mapLanguageToJson($this->language),
            'font_factor' => $this->mapFontFactorToJson($this->fontFactor),
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];

        return $data;
    }

    private function mapThemeToJson($theme): array
    {
        return [
            'uuid' => $theme->uuid->__toString(),
            'name' => $theme->name,
            'primary' => $theme->primary,
            'primary_variant' => $theme->primaryVariant,
            'secondary' => $theme->secondary,
            'secondary_variant' => $theme->secondaryVariant,
            'accent' => $theme->accent,
            'accent_variant' => $theme->accentVariant,
            'background' => $theme->background,
            'background_variant' => $theme->backgroundVariant,
        ];
    }

    private function mapLanguageToJson($language): array
    {
        return [
            'uuid' => $language->uuid->__toString(),
            'name' => $language->name,
            'tag' => $language->tag,
        ];
    }

    private function mapFontFactorToJson($fontFactor): array
    {
        return [
            'uuid' => $fontFactor->uuid->__toString(),
            'value' => $fontFactor->value
        ];
    }
}
