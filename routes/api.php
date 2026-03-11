<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

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
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
