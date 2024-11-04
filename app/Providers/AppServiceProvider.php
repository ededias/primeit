<?php

namespace App\Providers;

use App\Repository\PatientInterface;
use App\Repository\PatientRepository;
use App\Repository\UserInterface;
use App\Repository\UserRepository;
use App\Service\PatientService;
use App\Service\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserService::class, function($app) {
            return new UserService($app->make(UserRepository::class));
        });
        $this->app->bind(PatientInterface::class, PatientRepository::class);
        $this->app->bind(PatientService::class, function($app) {
            return new PatientService($app->make(PatientRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
