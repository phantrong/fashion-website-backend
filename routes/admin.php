<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HousewareController;
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
});
