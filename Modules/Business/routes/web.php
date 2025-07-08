<?php

use Illuminate\Support\Facades\Route;
use Modules\Business\Http\Controllers\BusinessController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('businesses', BusinessController::class)->names('business');
});
