<?php

namespace App\Providers;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\District\DistrictRepository;
use App\Repositories\District\DistrictRepositoryInterface;
use App\Repositories\Houseware\HousewareRepository;
use App\Repositories\Houseware\HousewareRepositoryInterface;
use App\Repositories\InvalidToken\InvalidTokenRepository;
use App\Repositories\InvalidToken\InvalidTokenRepositoryInterface;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Room\RoomRepositoryInterface;
use App\Repositories\RoomHouseware\RoomHousewareRepository;
use App\Repositories\RoomHouseware\RoomHousewareRepositoryInterface;
use App\Repositories\RoomMedia\RoomMediaRepository;
use App\Repositories\RoomMedia\RoomMediaRepositoryInterface;
use App\Repositories\RoomType\RoomTypeRepository;
use App\Repositories\RoomType\RoomTypeRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Verify\VerifyRepository;
use App\Repositories\Verify\VerifyRepositoryInterface;
use App\Repositories\Ward\WardRepository;
use App\Repositories\Ward\WardRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            InvalidTokenRepositoryInterface::class,
            InvalidTokenRepository::class
        );
        $this->app->singleton(
            RoomRepositoryInterface::class,
            RoomRepository::class
        );
        $this->app->singleton(
            ProvinceRepositoryInterface::class,
            ProvinceRepository::class
        );
        $this->app->singleton(
            DistrictRepositoryInterface::class,
            DistrictRepository::class
        );
        $this->app->singleton(
            WardRepositoryInterface::class,
            WardRepository::class
        );
        $this->app->singleton(
            HousewareRepositoryInterface::class,
            HousewareRepository::class
        );
        $this->app->singleton(
            AdminRepositoryInterface::class,
            AdminRepository::class
        );
        $this->app->singleton(
            RoomHousewareRepositoryInterface::class,
            RoomHousewareRepository::class
        );
        $this->app->singleton(
            RoomMediaRepositoryInterface::class,
            RoomMediaRepository::class
        );
        $this->app->singleton(
            VerifyRepositoryInterface::class,
            VerifyRepository::class
        );
        $this->app->singleton(
            RoomTypeRepositoryInterface::class,
            RoomTypeRepository::class
        );
    }
}
