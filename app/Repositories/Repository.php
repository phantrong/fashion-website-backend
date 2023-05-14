<?php

namespace App\Repositories;

use App\Repositories\Certificate\CertificateRepository;
use App\Repositories\Certificate\CertificateRepositoryInterface;
use App\Repositories\InvalidToken\InvalidTokenRepository;
use App\Repositories\InvalidToken\InvalidTokenRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserCertificate\UserCertificateRepository;
use App\Repositories\UserCertificate\UserCertificateRepositoryInterface;

class Repository
{
    /**
     * Get UserRepository.
     *
     * @return UserRepository
     */
    public static function getUser()
    {
        return app(UserRepositoryInterface::class);
    }

    /**
     * Get InvalidTokenRepository.
     *
     * @return InvalidTokenRepository
     */
    public static function getInvalidToken()
    {
        return app(InvalidTokenRepositoryInterface::class);
    }

    /**
     * Get CertificateRepository.
     *
     * @return CertificateRepository
     */
    public static function getCertificate()
    {
        return app(CertificateRepositoryInterface::class);
    }

    /**
     * Get UserCertificateRepository.
     *
     * @return UserCertificateRepository
     */
    public static function getUserCertificate()
    {
        return app(UserCertificateRepositoryInterface::class);
    }
}
