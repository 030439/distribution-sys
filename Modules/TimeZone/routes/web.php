<?php

use Illuminate\Support\Facades\Route;
use Modules\TimeZone\Http\Controllers\TimeZoneController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('timezones', TimeZoneController::class)->names('timezone');
});
