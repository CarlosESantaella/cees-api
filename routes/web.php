<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReceptionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json(["message" => "Hello World!"], 200);
});
// Reports
Route::middleware('permission:MANAGE RECEPTIONS')->group(function () {
    Route::get('/receptions/{id}/pdf', [ReceptionsController::class, 'generateReport']);
    Route::get('/receptions/excel', [ReceptionsController::class, 'exportExcel']);
});
