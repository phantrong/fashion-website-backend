<?php

namespace App\Providers;

use App\Services\Business\Certificate\CertificateService;
use App\Services\Business\Certificate\CertificateServiceInterface;
use App\Services\Business\User\UserService;
use App\Services\Business\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class BusinessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
        $this->app->bind(
            CertificateServiceInterface::class,
            CertificateService::class
        );
    }
}
