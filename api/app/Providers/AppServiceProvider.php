<?php

namespace App\Providers;

use App\Repositories\Eloquent\TodoListRepository;
use Src\Adapters\Authentication\PassportAuthenticationAdapter;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;
use Src\Adapters\Authentication\AuthenticationInterface;
use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
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

        $this->app->singleton(
            TodoListRepositoryInterface::class,
            TodoListRepository::class
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
