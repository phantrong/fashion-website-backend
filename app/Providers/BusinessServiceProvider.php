<?php

namespace App\Providers;

use App\Services\Business\Admin\AdminService;
use App\Services\Business\Admin\AdminServiceInterface;
use App\Services\Business\District\DistrictService;
use App\Services\Business\District\DistrictServiceInterface;
use App\Services\Business\HomepageAccessTime\HomepageAccessTimeService;
use App\Services\Business\HomepageAccessTime\HomepageAccessTimeServiceInterface;
use App\Services\Business\Houseware\HousewareService;
use App\Services\Business\Houseware\HousewareServiceInterface;
use App\Services\Business\Province\ProvinceService;
use App\Services\Business\Province\ProvinceServiceInterface;
use App\Services\Business\User\UserService;
use App\Services\Business\User\UserServiceInterface;
use App\Services\Business\Room\RoomService;
use App\Services\Business\Room\RoomServiceInterface;
use App\Services\Business\RoomHouseware\RoomHousewareService;
use App\Services\Business\RoomHouseware\RoomHousewareServiceInterface;
use App\Services\Business\RoomMedia\RoomMediaService;
use App\Services\Business\RoomMedia\RoomMediaServiceInterface;
use App\Services\Business\RoomType\RoomTypeService;
use App\Services\Business\RoomType\RoomTypeServiceInterface;
use App\Services\Business\RoomViewTime\RoomViewTimeService;
use App\Services\Business\RoomViewTime\RoomViewTimeServiceInterface;
use App\Services\Business\Verify\VerifyService;
use App\Services\Business\Verify\VerifyServiceInterface;
use App\Services\Business\Ward\WardService;
use App\Services\Business\Ward\WardServiceInterface;
use Illuminate\Support\ServiceProvider;

class BusinessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
        $this->app->bind(
            RoomServiceInterface::class,
            RoomService::class
        );
        $this->app->bind(
            ProvinceServiceInterface::class,
            ProvinceService::class
        );
        $this->app->bind(
            DistrictServiceInterface::class,
            DistrictService::class
        );
        $this->app->bind(
            WardServiceInterface::class,
            WardService::class
        );
        $this->app->bind(
            HousewareServiceInterface::class,
            HousewareService::class
        );
        $this->app->bind(
            AdminServiceInterface::class,
            AdminService::class
        );
        $this->app->bind(
            RoomHousewareServiceInterface::class,
            RoomHousewareService::class
        );
        $this->app->bind(
            RoomMediaServiceInterface::class,
            RoomMediaService::class
        );
        $this->app->bind(
            VerifyServiceInterface::class,
            VerifyService::class
        );
        $this->app->bind(
            RoomTypeServiceInterface::class,
            RoomTypeService::class
        );
        $this->app->bind(
            HomepageAccessTimeServiceInterface::class,
            HomepageAccessTimeService::class
        );
        $this->app->bind(
            RoomViewTimeServiceInterface::class,
            RoomViewTimeService::class
        );
    }
}
