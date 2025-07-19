<?php

use Illuminate\Support\Facades\Route;
use Modules\TimeZone\Http\Controllers\TimeZoneController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('timezones', TimeZoneController::class)->names('timezone');
});
