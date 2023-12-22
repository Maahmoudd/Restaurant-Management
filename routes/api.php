<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    // Reservation routes
    Route::post('/reservations', [ReservationController::class, 'create']);
    Route::patch('/reservations/{id}', [ReservationController::class, 'update']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'cancel']);
    Route::get('/user/reservations', [ReservationController::class, 'index']);

    // Payment routes (if separate)
    Route::post('/payments', [PaymentController::class, 'process']);
    Route::get('/payments/{id}', [PaymentController::class, 'show']);

    // Logout route
    Route::post('/logout', [UserController::class, 'logout']);
});
