<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ReservationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/parkings/avalability', [ParkingController::class, 'GetParkingAvalabiltiy']);
    Route::get('parkings', [ParkingController::class, 'index']);
    //Route::middleware(isAdmin::class)->apiResource('parkings', ParkingController::class);
    Route::middleware(IsAdmin::class)->group(function () {
        Route::get('/parkings/stats', [ParkingController::class, 'getParkingStats']);
        Route::post('parkings', [ParkingController::class, 'store']);
        Route::get('parkings/{parking}', [ParkingController::class, 'show']);
        Route::put('parkings/{parking}', [ParkingController::class, 'update']);
        Route::delete('parkings/{parking}', [ParkingController::class, 'destroy']);
    });
    Route::apiResource('reservations', ReservationsController::class);
    Route::get('/myreservations', [ReservationsController::class, 'myReservation']);
});





