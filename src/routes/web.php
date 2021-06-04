<?php

use Illuminate\Support\Facades\Route;

Route::get('/package', function () {
    echo "Package working fine";
});
Route::get('/auth/user/login', [\Sparkouttech\UserAuth\app\Http\Controllers\UserController::class, 'login']);
