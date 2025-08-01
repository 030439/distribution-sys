<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;
Route::post('sign', [UserController::class, 'login'])->name('sign');
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class)->names('user');
});
