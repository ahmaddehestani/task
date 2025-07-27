<?php


use App\Http\Controllers\V1\EventController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('event', [EventController::class, 'store']);
    Route::get('event', [EventController::class, 'index']);
});
