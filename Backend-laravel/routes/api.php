<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("v1/clientes", ClientesController::class);//ruta para acceder a todos los clientes

Route::apiResource("v1/usuarios", UserController::class);//ruta para acceder a usuarios

Route::apiResource('v1/stripe', StripeController::class);

