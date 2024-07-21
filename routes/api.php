<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComexListController;
use App\Http\Controllers\ComexDashboardTransportController;

Route::prefix('v1')->group(function () {
    Route::post('comex-list', [ComexListController::class, 'index']);
    Route::post('comex-dashboard-transport', [ComexDashboardTransportController::class, 'index']);
});
