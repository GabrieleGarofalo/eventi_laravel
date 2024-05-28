<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventoController as APIEventoController;
use App\Http\Controllers\API\PersonaController as APIPersonaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::apiResource('eventos', APIEventoController::class);
Route::apiResource('personas', APIPersonaController::class);
