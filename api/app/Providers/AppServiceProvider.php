<?php

namespace App\Providers;

use App\Repositories\Eloquent\ApplicationPreferencesEloquentRepository;
use App\Repositories\Eloquent\EmailResetTokenEloquentRepository;
use App\Repositories\Eloquent\TagEloquentRepository;
use App\Repositories\Eloquent\TodoEloquentRepository;
use App\Repositories\Eloquent\TodoGroupEloquentRepository;
use App\Repositories\Eloquent\TodoListEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;
use Src\Adapters\Authentication\AuthenticationInterface;
use Src\Adapters\Authentication\PassportAuthenticationAdapter;
use Src\Adapters\Repositories\EmailResetTokenRepository\EmailResetTokenRepositoryInterface;
use Src\Adapters\Repositories\PreferencesRepository\ApplicationPreferencesRepositoryInterface;
use Src\Adapters\Repositories\TagRepository\TagRepositoryInterface;
use Src\Adapters\Repositories\TodoGroupRepository\TodoGroupRepositoryInterface;
use Src\Adapters\Repositories\TodoListRepository\TodoListRepositoryInterface;
use Src\Adapters\Repositories\TodoRepository\TodoRepositoryInterface;
use Src\Adapters\Repositories\UserRepository\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * RegisterPage any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );

        $this->app->singleton(
            AuthenticationInterface::class,
            PassportAuthenticationAdapter::class
        );

        $this->app->singleton(
            TodoListRepositoryInterface::class,
            TodoListEloquentRepository::class
        );

        $this->app->singleton(
            TodoRepositoryInterface::class,
            TodoEloquentRepository::class
        );

        $this->app->singleton(
            TagRepositoryInterface::class,
            TagEloquentRepository::class
        );

        $this->app->singleton(
            ApplicationPreferencesRepositoryInterface::class,
            ApplicationPreferencesEloquentRepository::class,
        );

        $this->app->singleton(
            EmailResetTokenRepositoryInterface::class,
            EmailResetTokenEloquentRepository::class
        );

//        $this->app->singleton(
//            TodoGroupRepositoryInterface::class,
//            TodoGroupEloquentRepository::class
//        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
