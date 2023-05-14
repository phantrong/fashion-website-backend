<?php

namespace App\Providers;

use App\Services\Api\ResponseFactoryInterface;
use App\Services\Api\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register API service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ResponseFactoryInterface::class,
            ResponseFactory::class
        );
    }

    /**
     * Get the API service provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            ApiServiceProvider::class,
        ];
    }
}
