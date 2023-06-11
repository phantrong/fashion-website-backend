<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageAccessTimeController;
use App\Http\Controllers\InterestedRoomController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'loginUser'])->name('user.login');
Route::post('login-google', [AuthController::class, 'loginUserByGoogle'])->name('user.login.google');
Route::post('verify_email', [UserController::class, 'verifyEmail'])->name('user.verify_email');
Route::post('register', [UserController::class, 'registerUser'])->name('user.register');
Route::post('register/verify-email', [UserController::class, 'verifyEmail'])->name('user.verify.email');

// anonymous user
Route::get(
    'homepage/access-times/total',
    [HomepageAccessTimeController::class, 'getTotalAccessTimes']
)->name('homepage.access_times.total');

Route::controller(RoomController::class)
    ->prefix('room')
    ->name('room.')
    ->group(function () {
        Route::get('search', 'getListSearchByUser')->name('search');
        Route::get('list-search-key-word', 'getListHistorySearchKeyWord')->name('list.search.key_word');
        Route::delete('delete-search-key-word/{id}', 'deleteHistorySearchKeyWord')->name('delete.search.key_word');
        Route::get('detail/{id}', 'getDetailByUser')->name('detail');
        Route::get('list-related/{id}', 'getListRelatedByDetail')->name('list.related');
        Route::get('list-history-view', 'getListRoomHistoryViewByUser')->name('list.history.view');
        Route::get('list-suggestion', 'getListSuggestion')->name('list.suggestion');
        Route::get('count/by-address', 'getCountRoomByAddressHomepage')->name('count.by_address');
    });

Route::controller(InterestedRoomController::class)
    ->prefix('interested-room')
    ->name('interested.room.')
    ->group(function () {
        Route::post('add', 'addItem')->name('add.item');
        Route::post('remove', 'removeItem')->name('remove.item');
        Route::get('list', 'getListByUser')->name('list');
        Route::get('list-detail', 'getListDetailByUser')->name('list.detail');
    });

// authen user
Route::group([
    'middleware' => [
        'check_token',
    ],
    'as' => 'user.',
], function () {
    Route::post('logout', [AuthController::class, 'logoutUser'])->name('logout');

    Route::controller(UserController::class)
        ->prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', 'getUserProfile')->name('get');
            Route::post('update', 'updateUserProfile')->name('update');
        });
});
