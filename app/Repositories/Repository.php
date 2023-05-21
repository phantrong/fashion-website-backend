<?php

namespace App\Repositories;

use App\Repositories\InvalidToken\InvalidTokenRepository;
use App\Repositories\InvalidToken\InvalidTokenRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;

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
     * Get RoomRepository.
     *
     * @return RoomRepository
     */
    public static function getRoom()
    {
        return app(RoomRepositoryInterface::class);
    }
}
