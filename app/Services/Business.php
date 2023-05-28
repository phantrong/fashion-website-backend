<?php

namespace App\Services;

use App\Services\Business\Admin\AdminService;
use App\Services\Business\Admin\AdminServiceInterface;
use App\Services\Business\User\UserService;
use App\Services\Business\User\UserServiceInterface;
use App\Services\Business\Room\RoomService;
use App\Services\Business\Room\RoomServiceInterface;
use App\Services\Business\District\DistrictService;
use App\Services\Business\District\DistrictServiceInterface;
use App\Services\Business\Houseware\HousewareService;
use App\Services\Business\Houseware\HousewareServiceInterface;
use App\Services\Business\Province\ProvinceService;
use App\Services\Business\Province\ProvinceServiceInterface;
use App\Services\Business\Ward\WardService;
use App\Services\Business\Ward\WardServiceInterface;
use App\Services\Business\RoomHouseware\RoomHousewareService;
use App\Services\Business\RoomHouseware\RoomHousewareServiceInterface;
use App\Services\Business\RoomMedia\RoomMediaService;
use App\Services\Business\RoomMedia\RoomMediaServiceInterface;
use App\Services\Business\Verify\VerifyService;
use App\Services\Business\Verify\VerifyServiceInterface;

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

    /**
     * Get ProvinceService.
     *
     * @return ProvinceService
     */
    public static function getProvince()
    {
        return app(ProvinceServiceInterface::class);
    }

    /**
     * Get DistrictService.
     *
     * @return DistrictService
     */
    public static function getDistrict()
    {
        return app(DistrictServiceInterface::class);
    }

    /**
     * Get WardService.
     *
     * @return WardService
     */
    public static function getWard()
    {
        return app(WardServiceInterface::class);
    }

    /**
     * Get HousewareService.
     *
     * @return HousewareService
     */
    public static function getHouseware()
    {
        return app(HousewareServiceInterface::class);
    }

    /**
     * Get AdminService.
     *
     * @return AdminService
     */
    public static function getAdmin()
    {
        return app(AdminServiceInterface::class);
    }

    /**
     * Get RoomHousewareService.
     *
     * @return RoomHousewareService
     */
    public static function getRoomHouseware()
    {
        return app(RoomHousewareServiceInterface::class);
    }

    /**
     * Get RoomMediaService.
     *
     * @return RoomMediaService
     */
    public static function getRoomMedia()
    {
        return app(RoomMediaServiceInterface::class);
    }

    /**
     * Get VerifyService.
     *
     * @return VerifyService
     */
    public static function getVerify()
    {
        return app(VerifyServiceInterface::class);
    }
}
