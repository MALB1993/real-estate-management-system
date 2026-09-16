<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\API\PropertyImageController;
use App\Http\Controllers\API\VisitRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public Property Routes (Anyone can view)
Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/{property}', [PropertyController::class, 'show']);

// Protected Routes (Requires Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Protected Property Routes (Only Authenticated Users)
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::put('/properties/{property}', [PropertyController::class, 'update']);
    Route::patch('/properties/{property}', [PropertyController::class, 'update']);
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy']);

    Route::post('/properties/{property}/images', [PropertyImageController::class, 'store']);
    Route::delete('/properties/{property}/images/{image}', [PropertyImageController::class, 'destroy']);

    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/properties/{property}/favorite', [FavoriteController::class, 'toggle']);

    Route::get('/visit-requests', [VisitRequestController::class, 'index']);
    Route::post('/visit-requests', [VisitRequestController::class, 'store']);
    Route::patch('/visit-requests/{visitRequest}/status', [VisitRequestController::class, 'updateStatus']);
    Route::post('/visit-requests/{visitRequest}/cancel', [VisitRequestController::class, 'cancel']);
});
