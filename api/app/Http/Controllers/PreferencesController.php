<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAppPreferencesRequest;
use Illuminate\Http\Request;
use Src\Adapters\Presenters\GroupedPreferencesPresenter;
use Src\Adapters\Presenters\PreferencesPresenter;
use Src\Domain\ValueObjects\Uuid;
use Src\UseCases\ApplicationPreferences\GetAllPreferences\GetAllPreferences;
use Src\UseCases\ApplicationPreferences\GetUserPreferences\GetUserPreferences;
use Src\UseCases\ApplicationPreferences\GetUserPreferences\GetUserPreferencesInput;
use Src\UseCases\ApplicationPreferences\UpdateUserPreferences\UpdateUserPreferences;
use Src\UseCases\ApplicationPreferences\UpdateUserPreferences\UpdateUserPreferencesInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;

class PreferencesController extends Controller
{
    public function index(GetAllPreferences $useCase): GroupedPreferencesPresenter
    {
        $response = $useCase->handle();

        return new GroupedPreferencesPresenter($response->preferences);
    }

    public function get(Request $request, GetUserPreferences $useCase, GetUserByToken $userUseCase): PreferencesPresenter
    {
        $userData = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            input: new GetUserPreferencesInput(
                $userData->id
            )
        );

        return new PreferencesPresenter($response->preferences);
    }

    public function update(UpdateAppPreferencesRequest $request, UpdateUserPreferences $useCase, GetUserByToken $userUseCase)
    {
        $userData = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new UpdateUserPreferencesInput(
                themeUuid: new Uuid($request->theme_uuid),
                languageUuid: new Uuid($request->language_uuid),
                fontFactorUuid: new Uuid($request->font_factor_uuid),
                userId: $userData->id,
            )
        );

        return new PreferencesPresenter($response->preferences);
    }

}
