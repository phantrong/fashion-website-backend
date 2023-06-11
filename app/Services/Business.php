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
use App\Services\Business\RoomType\RoomTypeService;
use App\Services\Business\RoomType\RoomTypeServiceInterface;
use App\Services\Business\HomepageAccessTime\HomepageAccessTimeService;
use App\Services\Business\HomepageAccessTime\HomepageAccessTimeServiceInterface;
use App\Services\Business\RoomViewTime\RoomViewTimeService;
use App\Services\Business\RoomViewTime\RoomViewTimeServiceInterface;
use App\Services\Business\InterestedRoom\InterestedRoomService;
use App\Services\Business\InterestedRoom\InterestedRoomServiceInterface;
use App\Services\Business\InterestedRoomItem\InterestedRoomItemService;
use App\Services\Business\InterestedRoomItem\InterestedRoomItemServiceInterface;
use App\Services\Business\HistorySearchKeyWord\HistorySearchKeyWordService;
use App\Services\Business\HistorySearchKeyWord\HistorySearchKeyWordServiceInterface;
use App\Services\Business\InterestedRoomInfomation\InterestedRoomInfomationService;
use App\Services\Business\InterestedRoomInfomation\InterestedRoomInfomationServiceInterface;

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

    /**
     * Get RoomTypeService.
     *
     * @return RoomTypeService
     */
    public static function getRoomType()
    {
        return app(RoomTypeServiceInterface::class);
    }

    /**
     * Get HomepageAccessTimeService.
     *
     * @return HomepageAccessTimeService
     */
    public static function getHomepageAccessTime()
    {
        return app(HomepageAccessTimeServiceInterface::class);
    }

    /**
     * Get RoomViewTimeService.
     *
     * @return RoomViewTimeService
     */
    public static function getRoomViewTime()
    {
        return app(RoomViewTimeServiceInterface::class);
    }

    /**
     * Get InterestedRoomService.
     *
     * @return InterestedRoomService
     */
    public static function getInterestedRoom()
    {
        return app(InterestedRoomServiceInterface::class);
    }

    /**
     * Get InterestedRoomItemService.
     *
     * @return InterestedRoomItemService
     */
    public static function getInterestedRoomItem()
    {
        return app(InterestedRoomItemServiceInterface::class);
    }

    /**
     * Get HistorySearchKeyWordService.
     *
     * @return HistorySearchKeyWordService
     */
    public static function getHistorySearchKeyWord()
    {
        return app(HistorySearchKeyWordServiceInterface::class);
    }

    /**
     * Get InterestedRoomInfomationService.
     *
     * @return InterestedRoomInfomationService
     */
    public static function getInterestedRoomInfomation()
    {
        return app(InterestedRoomInfomationServiceInterface::class);
    }
}
