<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'loginUser'])->name('user.login');
Route::post('login-google', [AuthController::class, 'loginUserByGoogle'])->name('user.login.google');
Route::post('verify_email', [UserController::class, 'verifyEmail'])->name('user.verify_email');
Route::post('register', [UserController::class, 'registerUser'])->name('user.register');
Route::post('register/verify-email', [UserController::class, 'verifyEmail'])->name('user.verify.email');

// anonymous user


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
