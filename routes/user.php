<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'loginUser'])->name('user.login');
Route::group([
    'middleware' => [
        'check_token',
    ],
    'as' => 'user.',
], function () {
    Route::post('upload-file', [FileController::class, 'upload']);

    /**
     * User
     */
    Route::post('logout', [AuthController::class, 'logoutUser'])->name('logout');
    Route::get('users', [UserController::class, 'list'])->name('user.list');
    Route::get('user/{id}', [UserController::class, 'getDetail'])->name('user.detail');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
});