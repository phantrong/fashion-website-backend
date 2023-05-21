<?php

namespace App\Services;

use App\Services\Business\User\UserService;
use App\Services\Business\User\UserServiceInterface;
use App\Services\Business\Room\RoomService;
use App\Services\Business\Room\RoomServiceInterface;

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
     * Get RoomService.
     *
     * @return RoomService
     */
    public static function getRoom()
    {
        return app(RoomServiceInterface::class);
    }
}
