<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\TravelPackagesController;
use Illuminate\Support\Facades\Route;

Route::apiResource('package', TravelPackagesController::class);
Route::apiResource('booking', BookingsController::class);
Route::get('get-location-details', [TravelPackagesController::class, 'getDetails']);
