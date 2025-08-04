<?php

use App\Http\Controllers\CustomHealthCheckController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\ValidateSchema;
use Illuminate\Support\Facades\Route;

Route::prefix('transacao')->controller(TransactionController::class)->group(function() {
    Route::post('/', 'receive')->middleware(ValidateSchema::class);
    Route::delete('/', 'delete');
});

Route::get('estatistica', [StatisticController::class, 'getStatistics']);

Route::get('health', CustomHealthCheckController::class);
