<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\VaccinationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('consultations', [ConsultationController::class, 'index']);
        Route::post('consultations', [ConsultationController::class, 'store']);
        Route::get('spots', [SpotController::class, 'index']);
        Route::get('spots/{id}', [SpotController::class, 'show']);
        Route::post('vaccinations', [VaccinationController::class, 'store']);
        Route::get('vaccinations', [VaccinationController::class, 'index']);
    });

});
