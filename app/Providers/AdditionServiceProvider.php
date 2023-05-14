<?php

namespace App\Providers;

use App\Services\File\FileService;
use App\Services\File\FileServiceInterface;
use App\Services\Token\JwtService;
use App\Services\Token\JwtServiceInterface;
use Illuminate\Support\ServiceProvider;

class AdditionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            JwtServiceInterface::class,
            JwtService::class
        );
        $this->app->bind(
            FileServiceInterface::class,
            FileService::class
        );
    }
}
