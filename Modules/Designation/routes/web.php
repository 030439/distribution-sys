<?php

use Illuminate\Support\Facades\Route;
use Modules\Designation\Http\Controllers\DesignationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('designations', DesignationController::class)->names('designation');
});
