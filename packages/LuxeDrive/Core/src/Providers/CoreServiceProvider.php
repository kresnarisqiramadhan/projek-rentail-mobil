<?php

namespace LuxeDrive\Core\Providers;

use Illuminate\Support\ServiceProvider;
use LuxeDrive\Core\Repositories\VehicleRepositoryInterface;
use LuxeDrive\Core\Repositories\VehicleRepository;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(VehicleRepositoryInterface::class, VehicleRepository::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
