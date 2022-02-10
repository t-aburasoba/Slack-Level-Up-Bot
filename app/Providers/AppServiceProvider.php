<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\LevelsExperience\LevelsExperienceRepositoryInterface::class,
            \App\Repositories\LevelsExperience\LevelsExperienceRepository::class
        );
        $this->app->bind(
            \App\Repositories\Workspace\WorkspaceRepositoryInterface::class,
            \App\Repositories\Workspace\WorkspaceRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
