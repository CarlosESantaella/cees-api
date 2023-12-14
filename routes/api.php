<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

// Routers public
Route::post('auth', [AuthController::class, 'login']);

// Routers private
Route::middleware('jwt.verify')->group(function () {

    // Users
    Route::middleware('permission:MANAGE USERS:All')->group(function () {
        Route::apiResource('users', UserController::class);
    });

    // Profiles
    Route::middleware('permission:MANAGE PROFILES:All')->group(function () {
        Route::apiResource('profiles', ProfileController::class);
    });

    // Permissions
    Route::middleware('permission:MANAGE PROFILES:All')->group(function () {
        Route::get('permissions', [ProfileController::class, 'getPermissions']);
    });

});
