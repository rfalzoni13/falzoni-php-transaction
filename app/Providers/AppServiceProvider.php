<?php

namespace App\Providers;

use App\Check\HealthCheck;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        Health::checks([
            HealthCheck::new()
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
