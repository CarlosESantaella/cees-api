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
        Route::put('configurations', [ConfigurationsController::class, 'update']);
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
    Route::middleware('permission:MANAGE DIAGNOSES AND QUOTES')->group(function () {
        Route::apiResource('diagnoses', DiagnosesController::class);
        Route::patch('diagnoses/{id}/status/{status}', [DiagnosesController::class, 'updateStatus']);
    });

    // Failure Modes Diagnoses
    Route::middleware('permission:MANAGE DIAGNOSES AND QUOTES')->group(function () {
        Route::put('diagnoses/{diagnoses_id}/failure-modes', [FailureModesDiagnosesController::class, 'update']);
    });

    // Diagnoses Files
    Route::middleware('permission:MANAGE DIAGNOSES AND QUOTES')->group(function () {
        Route::get('diagnoses/{diagnoses_id}/files', [DiagnosesFilesController::class, 'index']);
        Route::get('diagnoses/{diagnoses_id}/files/{file_id}', [DiagnosesFilesController::class, 'index']);
        Route::post('diagnoses/{diagnoses_id}/upload-file', [DiagnosesFilesController::class, 'uploadFile']);
        Route::delete('diagnoses/{diagnoses_id}/files/{file_id}', [DiagnosesFilesController::class, 'destroy']);
    });

    // Diagnoses Items
    Route::middleware('permission:MANAGE DIAGNOSES AND QUOTES')->group(function () {
        Route::post('diagnoses/{diagnoses_id}/items', [DiagnosesItemsController::class, 'store']);
        Route::put('diagnoses/{diagnoses_id}/items/{item_id}', [DiagnosesItemsController::class, 'update']);
        Route::delete('diagnoses/{diagnoses_id}/items/{item_id}', [DiagnosesItemsController::class, 'destroy']);
    });

    // Photos Items Diagnoses
    Route::middleware('permission:MANAGE DIAGNOSES AND QUOTES')->group(function () {
        Route::get('diagnoses/{diagnoses_id}/items/{item_id}/photos', [PhotosItemsDiagnosesController::class, 'index']);
        Route::get('diagnoses/{diagnoses_id}/items/{item_id}/photos/{photo_id}', [PhotosItemsDiagnosesController::class, 'show']);
        Route::post('diagnoses/{diagnoses_id}/items/{item_id}/photos', [PhotosItemsDiagnosesController::class, 'store']);
        Route::delete('diagnoses/{diagnoses_id}/items/{item_id}/photos/{photo_id}', [PhotosItemsDiagnosesController::class, 'destroy']);
    });

});
