<?php

use Illuminate\Support\Facades\Route;
use Modules\Plan\Http\Controllers\PlanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('plans', PlanController::class)->names('plan');
});
