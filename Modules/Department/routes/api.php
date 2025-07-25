<?php

use Illuminate\Support\Facades\Route;
use Modules\Department\Http\Controllers\DepartmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('departments', DepartmentController::class)->names('department');
});
