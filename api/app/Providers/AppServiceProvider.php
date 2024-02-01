<?php

namespace App\Providers;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
