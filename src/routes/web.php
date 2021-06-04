<?php

use Illuminate\Support\Facades\Route;

use Sparkouttech\UserAuth\app\Http\Controllers\LoginController;
use Sparkouttech\UserAuth\app\Http\Controllers\RegisterController;
use Sparkouttech\UserAuth\app\Http\Controllers\ForgetPasswordController;

Route::group(['middleware' => 'web'], function() {
    //All the routes that belongs to the group goes here
    Route::get('/auth/user/login', [LoginController::class, 'login'])->name('userAuth.login.page');
    Route::post('/auth/user/login', [LoginController::class, 'doLogin'])->name('userAuth.login');
    Route::get('/auth/user/register', [RegisterController::class, 'register'])->name('userAuth.register.page');
    Route::post('/auth/user/register', [RegisterController::class, 'doRegister'])->name('userAuth.register');
    Route::get('/auth/user/forget-password', [ForgetPasswordController::class, 'forgetPasswordPage'])->name('userAuth.forgetPasswordPage');
    Route::post('/auth/user/check-email', [ForgetPasswordController::class, 'checkEmail'])->name('userAuth.check-email');

});

