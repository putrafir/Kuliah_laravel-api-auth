<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'Test endpoint working!']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum', CheckRole::class . ':admin'])->get('/admin', function () {
    return response()->json(['message' => 'Welcome Admin!']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);
});

// Route::middleware(['auth:sanctum', CheckRole::class . ':admin'])->group(function () {
//     Route::delete('/user{id}', [AuthController::class, 'deleteUser']);
// });

Route::middleware(['auth:sanctum', CheckRole::class . ':admin'])->group(function () {
    Route::delete('/user/{id}', [AuthController::class, 'deleteUser']);
});


Route::middleware(['auth:sanctum', CheckRole::class . ':admin'])->get('/users', [AuthController::class, 'getAllUsers']);
