<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceptionsController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\DiagnosesController;
use App\Http\Controllers\DiagnosesFilesController;
use App\Http\Controllers\DiagnosesItemsController;
use App\Http\Controllers\FailureModesController;
use App\Http\Controllers\FailureModesDiagnosesController;
use App\Http\Controllers\PhotosItemsDiagnosesController;

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
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);
Route::post('auth/validate-reset-password-token', [AuthController::class, 'validateResetPasswordToken']);

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

    // Configurations
    Route::middleware('permission:MANAGE CONFIGURATIONS')->group(function () {
        Route::get('configurations', [ConfigurationsController::class, 'index']);
        Route::post('configurations', [ConfigurationsController::class, 'update']);
    });

    // Clients
    Route::middleware('permission:MANAGE CLIENTS')->group(function () {
        Route::apiResource('clients', ClientController::class);
    });

    // Receptions
    Route::middleware('permission:MANAGE RECEPTIONS')->group(function () {
        Route::post('receptions/update/{id}', [ReceptionsController::class, 'update']);
        Route::get('receptions/find', [ReceptionsController::class, 'find']);
        Route::apiResource('receptions', ReceptionsController::class);
        Route::get('/receptions/{id}/send-mail', [ReceptionsController::class, 'sendMailReport']);
    });

    // Permissions
    Route::get('permissions', [ProfileController::class, 'getPermissions']);

    // Rates
    Route::middleware('permission:MANAGE RATES')->group(function () {
        Route::apiResource('rates', RatesController::class);
    });

    // Items
    Route::middleware('permission:MANAGE ITEMS')->group(function () {
        Route::apiResource('items', ItemsController::class);
    });

    // Failure Modes
    Route::middleware('permission:MANAGE FAILURE MODES')->group(function () {
        Route::apiResource('failure-modes', FailureModesController::class);
    });

    // Diagnoses 
    Route::middleware('permission:MANAGE DIAGNOSES')->group(function () {
        Route::apiResource('diagnoses', DiagnosesController::class);
        Route::patch('diagnoses/{id}/status/{status}', [DiagnosesController::class, 'updateStatus']);
    });

    // Failure Modes Diagnoses
    Route::middleware('permission:MANAGE DIAGNOSES')->group(function () {
        Route::put('diagnoses/{diagnoses_id}/failure-modes', [FailureModesDiagnosesController::class, 'update']);
    });

    // Diagnoses Files
    Route::middleware('permission:MANAGE DIAGNOSES')->group(function () {
        Route::get('diagnoses/{diagnoses_id}/files', [DiagnosesFilesController::class, 'index']);
        Route::get('diagnoses/{diagnoses_id}/files/{file_id}', [DiagnosesFilesController::class, 'index']);
        Route::post('diagnoses/{diagnoses_id}/upload-file', [DiagnosesFilesController::class, 'uploadFile']);
        Route::delete('diagnoses/{diagnoses_id}/files/{file_id}', [DiagnosesFilesController::class, 'destroy']);
    });

    // Diagnoses Items
    Route::middleware('permission:MANAGE DIAGNOSES')->group(function () {
        Route::get('diagnoses/{diagnoses_id}/items', [DiagnosesItemsController::class, 'index']);
        Route::put('diagnoses/{diagnoses_id}/items', [DiagnosesItemsController::class, 'update']);
    });

    // Photos Items Diagnoses
    Route::middleware('permission:MANAGE DIAGNOSES')->group(function () {
        Route::get('diagnoses/{diagnoses_id}/items/photos', [PhotosItemsDiagnosesController::class, 'index']);
        Route::post('diagnoses/{diagnoses_id}/items/photos', [PhotosItemsDiagnosesController::class, 'store']);
    });

});
