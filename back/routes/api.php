<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user-info', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    //protected routes
    Route::post('cars',                     [CarsController::class, 'store']);
    Route::post('cars/{id}',                [CarsController::class, 'update']);
    Route::delete('cars/{id}',              [CarsController::class, 'destroy']);

    Route::post('logout',                   [AuthController::class, 'logout']);
});

Route::get('cars',                          [CarsController::class, 'index']);
Route::get('cars/{id}',                     [CarsController::class, 'show']);



