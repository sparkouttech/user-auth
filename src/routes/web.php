<?php

use Illuminate\Support\Facades\Route;

use Sparkouttech\UserAuth\app\Http\Controllers\UserController;
Route::get('/package', function () {
    echo "Package working fine";
});
Route::get('/auth/user/login', [UserController::class, 'login'])->name('userAuth.login.page');
Route::post('/auth/user/login', [UserController::class, 'doLogin'])->name('userAuth.login');
