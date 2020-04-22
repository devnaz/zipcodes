<?php

namespace App\Providers;

use App\Repositories\ZipRepository;
use App\Repositories\ZipRepositoryInterface;
use App\Services\HealthCheckService;
use App\Services\HealthCheckServiceInterface;
use App\Services\ImportService;
use App\Services\ImportServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HealthCheckServiceInterface::class, HealthCheckService::class);
        $this->app->singleton(ZipRepositoryInterface::class, ZipRepository::class);
        $this->app->singleton(ImportServiceInterface::class, function($app) {
            return new ImportService(
                $app->make(ZipRepositoryInterface::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
