<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Client;

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

    // Auth me
    Route::get('auth/me', [AuthController::class, 'me']);

    // Users
    Route::middleware('permission:MANAGE USERS')->group(function () {
        Route::apiResource('users', UserController::class);
    });

    // Profiles
    Route::get('profiles', [ProfileController::class, 'index']);
    Route::middleware('permission:MANAGE PROFILES')->group(function () {
        Route::apiResource('profiles', ProfileController::class)->except(['index']);
    });

    // Clients
    Route::middleware('permission:MANAGE CLIENTS')->group(function () {
        Route::apiResource('clients', ClientController::class);
    });

    // Permissions
    Route::get('permissions', [ProfileController::class, 'getPermissions']);

});
