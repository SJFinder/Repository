<?php

namespace SJFinder\Repository\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $configPath = __DIR__.'/../../../resources/config/repository.php';
        $this->publishes([
            $configPath => config_path('repository.php'),
        ], 'config');
        $this->mergeConfigFrom($configPath, 'repository');
    }

    public function register()
    {
    }

    public function provides()
    {
        return [];
    }
}
