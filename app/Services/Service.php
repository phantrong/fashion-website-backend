<?php

namespace App\Services;

use App\Services\Api\ResponseFactoryInterface;
use App\Services\File\FileService;
use App\Services\File\FileServiceInterface;
use App\Services\Token\JwtServiceInterface;

class Service
{
    /**
     * Get ResponseFactory.
     *
     * @return ResponseFactoryInterface
     */
    public static function response()
    {
        return app(ResponseFactoryInterface::class);
    }

    /**
     * Get JwtService.
     *
     * @return JwtServiceInterface
     */
    public static function getJWT()
    {
        return app(JwtServiceInterface::class);
    }

    /**
     * Get FileService.
     *
     * @return FileService
     */
    public static function getFile()
    {
        return app(FileServiceInterface::class);
    }
}
