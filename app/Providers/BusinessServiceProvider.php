<?php

namespace App\Providers;

use App\Services\Business\User\UserService;
use App\Services\Business\User\UserServiceInterface;
use App\Services\Business\Room\RoomService;
use App\Services\Business\Room\RoomServiceInterface;
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
    }
}
