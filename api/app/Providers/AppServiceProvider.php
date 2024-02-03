<?php

namespace App\Providers;

use Src\Adapters\Authentication\PassportAuthenticationAdapter;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;
use Src\Adapters\Authentication\AuthenticationInterface;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            AuthenticationInterface::class,
            PassportAuthenticationAdapter::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
