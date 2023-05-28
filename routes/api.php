<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::controller(AddressController::class)
    ->group(function () {
        Route::get('provinces', 'getListProvince')->name('list.province');
        Route::get('districts', 'getListDistrict')->name('list.district');
        Route::get('wards', 'getListWard')->name('list.ward');
    });
