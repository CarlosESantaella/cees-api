<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

Route::get('artisan-storage-link', function () {
    Artisan::call('storage:link');

    // Obtener la salida del comando
    $output = Artisan::output();

    echo "Comando ejecutado:<br><pre>$output</pre>";
});

Route::get('artisan-migrate', function () {
    Artisan::call('migrate:fresh --seed');

    // Obtener la salida del comando
    $output = Artisan::output();

    echo "Comando ejecutado:<br><pre>$output</pre>";
});

Route::middleware('jwt.verify')->group(function () {
    Route::middleware('permission:MANAGE RECEPTIONS')->group(function () {
        Route::get('/receptions/excel', [ReceptionsController::class, 'exportExcel']);
        Route::get('/receptions/{id}/pdf', [ReceptionsController::class, 'generateReport']);
        
    });
});
