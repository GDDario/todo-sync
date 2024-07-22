<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Adapters\Presenters\DashboardPresenter;
use Src\UseCases\Dashboard\GenerateDashboard\GenerateDashboard;
use Src\UseCases\Dashboard\GenerateDashboard\GenerateDashboardInput;
use Src\UseCases\User\GetUserByToken\GetUserByToken;
use Src\UseCases\User\GetUserByToken\GetUserByTokenInput;

class DashboardController extends Controller
{
    public function index(Request $request, GenerateDashboard $useCase, GetUserByToken $userUseCase)
    {
        $userData = $userUseCase->handle(
            new GetUserByTokenInput($request->bearerToken())
        );

        $response = $useCase->handle(
            new GenerateDashboardInput(
                $userData->id
            )
        );

        return new DashboardPresenter($response);
    }
}
