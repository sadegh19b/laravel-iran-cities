<?php

namespace Sadegh19b\LaravelIranCities;

use Illuminate\Support\ServiceProvider;
use Sadegh19b\LaravelIranCities\Commands\GenerateCommand;

class LaravelIranCitiesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCommand::class,
            ]);
        }
    }
} 