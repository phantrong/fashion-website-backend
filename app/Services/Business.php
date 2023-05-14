<?php

namespace App\Services;

use App\Services\Business\Certificate\CertificateService;
use App\Services\Business\Certificate\CertificateServiceInterface;
use App\Services\Business\User\UserService;
use App\Services\Business\User\UserServiceInterface;

class Business
{
    /**
     * Get UserService.
     *
     * @return UserService
     */
    public static function getUser()
    {
        return app(UserServiceInterface::class);
    }

    /**
     * Get CertificateService.
     *
     * @return CertificateService
     */
    public static function getCertificate()
    {
        return app(CertificateServiceInterface::class);
    }
}
