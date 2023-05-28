<?php

namespace App\Repositories;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\InvalidToken\InvalidTokenRepository;
use App\Repositories\InvalidToken\InvalidTokenRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\District\DistrictRepository;
use App\Repositories\District\DistrictRepositoryInterface;
use App\Repositories\Houseware\HousewareRepository;
use App\Repositories\Houseware\HousewareRepositoryInterface;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Ward\WardRepository;
use App\Repositories\Ward\WardRepositoryInterface;
use App\Repositories\RoomHouseware\RoomHousewareRepository;
use App\Repositories\RoomHouseware\RoomHousewareRepositoryInterface;
use App\Repositories\RoomMedia\RoomMediaRepository;
use App\Repositories\RoomMedia\RoomMediaRepositoryInterface;
use App\Repositories\Verify\VerifyRepository;
use App\Repositories\Verify\VerifyRepositoryInterface;

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

    /**
     * Get ProvinceRepository.
     *
     * @return ProvinceRepository
     */
    public static function getProvince()
    {
        return app(ProvinceRepositoryInterface::class);
    }

    /**
     * Get DistrictRepository.
     *
     * @return DistrictRepository
     */
    public static function getDistrict()
    {
        return app(DistrictRepositoryInterface::class);
    }

    /**
     * Get WardRepository.
     *
     * @return WardRepository
     */
    public static function getWard()
    {
        return app(WardRepositoryInterface::class);
    }

    /**
     * Get HousewareRepository.
     *
     * @return HousewareRepository
     */
    public static function getHouseware()
    {
        return app(HousewareRepositoryInterface::class);
    }

    /**
     * Get AdminRepository.
     *
     * @return AdminRepository
     */
    public static function getAdmin()
    {
        return app(AdminRepositoryInterface::class);
    }

    /**
     * Get RoomHousewareRepository.
     *
     * @return RoomHousewareRepository
     */
    public static function getRoomHouseware()
    {
        return app(RoomHousewareRepositoryInterface::class);
    }

    /**
     * Get RoomMediaRepository.
     *
     * @return RoomMediaRepository
     */
    public static function getRoomMedia()
    {
        return app(RoomMediaRepositoryInterface::class);
    }

    /**
     * Get VerifyRepository.
     *
     * @return VerifyRepository
     */
    public static function getVerify()
    {
        return app(VerifyRepositoryInterface::class);
    }
}
