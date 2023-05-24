<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HousewareController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\Adminer;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'loginAdmin'])->name('admin.login');

Route::group([
    'middleware' => [
        'check_token',
        Adminer::class
    ],
    'as' => 'admin.',
], function () {
    Route::post('logout', [AuthController::class, 'logoutAdmin'])->name('logout');

    Route::controller(HousewareController::class)
        ->prefix('houseware')
        ->name('houseware.')
        ->group(function () {
            Route::get('list', 'getList')->name('list');
            Route::get('{id}', 'getDetail')->name('detail');
            Route::post('create', 'create')->name('create');
            Route::post('{id}', 'update')->name('update');
            Route::delete('{id}', 'delete')->name('delete');
        });

    Route::controller(RoomController::class)
        ->prefix('room')
        ->name('room.')
        ->group(function () {
            Route::get('list', 'getListByAdmin')->name('admin.list');
            Route::get('{id}', 'getDetailByAdmin')->name('admin.detail');
            Route::post('upload-media', 'uploadMedia')->name('admin.upload.media');
            Route::post('create', 'createByAdmin')->name('admin.create');
            Route::post('update/{id}', 'updateByAdmin')->name('admin.update');
            Route::delete('{id}', 'deleteByAdmin')->name('admin.delete');
        });
});
