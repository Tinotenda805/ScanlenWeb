<?php

use App\Http\Controllers\AnalyticsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Analytics tracking endpoints
Route::middleware(['web'])->group(function () {
    Route::post('/analytics/time', [AnalyticsApiController::class, 'trackTime']);
    Route::post('/analytics/click', [AnalyticsApiController::class, 'trackClick']);
});
