<?php
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('user');

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('reservations', ReservationController::class)->except(['edit', 'create']);
    });

    Route::post('/payments', [PaymentController::class, 'process'])->name('payments.process');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
