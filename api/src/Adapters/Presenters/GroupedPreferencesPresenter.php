<?php

namespace Src\Adapters\Presenters;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupedPreferencesPresenter extends JsonResource
{
    public function toArray($request): array
    {
        $themes = array_map(fn ($theme) => $this->mapThemeToJson($theme), $this['themes']);
        $languages = array_map(fn ($language) => $this->mapLanguageToJson($language), $this['languages']);
        $fontFactors = array_map(fn ($fontFactor) => $this->mapFontFactorToJson($fontFactor), $this['fontFactors']);

        $data = [
            'themes' => $themes,
            'languages' => $languages,
            'font_factors' => $fontFactors,
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
