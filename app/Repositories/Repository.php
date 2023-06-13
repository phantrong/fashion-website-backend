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
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\RoomType\RoomTypeRepositoryInterface;
use App\Repositories\HomepageAccessTime\HomepageAccessTimeRepository;
use App\Repositories\HomepageAccessTime\HomepageAccessTimeRepositoryInterface;
use App\Repositories\RoomViewTime\RoomViewTimeRepository;
use App\Repositories\RoomViewTime\RoomViewTimeRepositoryInterface;
use App\Repositories\InterestedRoom\InterestedRoomRepository;
use App\Repositories\InterestedRoom\InterestedRoomRepositoryInterface;
use App\Repositories\InterestedRoomItem\InterestedRoomItemRepository;
use App\Repositories\InterestedRoomItem\InterestedRoomItemRepositoryInterface;
use App\Repositories\InterestedRoomInfomation\InterestedRoomInfomationRepository;
use App\Repositories\InterestedRoomInfomation\InterestedRoomInfomationRepositoryInterface;
use App\Repositories\HistorySearchKeyWord\HistorySearchKeyWordRepository;
use App\Repositories\HistorySearchKeyWord\HistorySearchKeyWordRepositoryInterface;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Contact\ContactRepositoryInterface;

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

    /**
     * Get RoomTypeRepository.
     *
     * @return RoomTypeRepository
     */
    public static function getRoomType()
    {
        return app(RoomTypeRepositoryInterface::class);
    }

    /**
     * Get HomepageAccessTimeRepository.
     *
     * @return HomepageAccessTimeRepository
     */
    public static function getHomepageAccessTime()
    {
        return app(HomepageAccessTimeRepositoryInterface::class);
    }

    /**
     * Get RoomViewTimeRepository.
     *
     * @return RoomViewTimeRepository
     */
    public static function getRoomViewTime()
    {
        return app(RoomViewTimeRepositoryInterface::class);
    }

    /**
     * Get InterestedRoomRepository.
     *
     * @return InterestedRoomRepository
     */
    public static function getInterestedRoom()
    {
        return app(InterestedRoomRepositoryInterface::class);
    }

    /**
     * Get InterestedRoomItemRepository.
     *
     * @return InterestedRoomItemRepository
     */
    public static function getInterestedRoomItem()
    {
        return app(InterestedRoomItemRepositoryInterface::class);
    }

    /**
     * Get HistorySearchKeyWordRepository.
     *
     * @return HistorySearchKeyWordRepository
     */
    public static function getHistorySearchKeyWord()
    {
        return app(HistorySearchKeyWordRepositoryInterface::class);
    }

    /**
     * Get InterestedRoomInfomationRepository.
     *
     * @return InterestedRoomInfomationRepository
     */
    public static function getInterestedRoomInfomation()
    {
        return app(InterestedRoomInfomationRepositoryInterface::class);
    }

    /**
     * Get ContactRepository.
     *
     * @return ContactRepository
     */
    public static function getContact()
    {
        return app(ContactRepositoryInterface::class);
    }
}
