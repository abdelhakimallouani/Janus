<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use App\Http\Controllers\StatsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/habits', [HabitController::class , 'store']);
    Route::get('/habits', [HabitController::class , 'index']);
    Route::get('/habits/{id}', [HabitController::class , 'show']);
    Route::put('/habits/{id}', [HabitController::class , 'update']);
    Route::delete('/habits/{id}', [HabitController::class , 'destroy']);

    Route::post('/habits/{id}/logs',[HabitLogController::class ,'store']);
    Route::get('/habits/{id}/logs',[HabitLogController::class ,'index']);
    Route::delete('/habits/{id}/logs/{logId}',[HabitLogController::class ,'destroy']);

    Route::get('/habits/{id}/stats',[StatsController::class, 'habitStats']);
    Route::get('/stats/overview',[StatsController::class, 'overview']);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
