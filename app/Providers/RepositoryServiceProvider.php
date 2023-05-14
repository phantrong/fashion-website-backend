<?php

namespace App\Providers;

use App\Repositories\Certificate\CertificateRepository;
use App\Repositories\Certificate\CertificateRepositoryInterface;
use App\Repositories\InvalidToken\InvalidTokenRepository;
use App\Repositories\InvalidToken\InvalidTokenRepositoryInterface;
use App\Repositories\UserCertificate\UserCertificateRepository;
use App\Repositories\UserCertificate\UserCertificateRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            InvalidTokenRepositoryInterface::class,
            InvalidTokenRepository::class
        );
        $this->app->singleton(
            CertificateRepositoryInterface::class,
            CertificateRepository::class
        );
        $this->app->singleton(
            UserCertificateRepositoryInterface::class,
            UserCertificateRepository::class
        );
    }
}
