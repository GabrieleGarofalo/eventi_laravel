<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PersonaController;

// Route per gli eventi
Route::resource('eventos', EventoController::class);

// Route per le persone


// Rotte per le persone
Route::prefix('eventos')->group(function () {
    Route::get('eventos/{evento}/register', [EventoController::class, 'RegisterForm'])->name('eventos.RegisterForm');
    Route::post('{evento}/register', [EventoController::class, 'register'])->name('eventos.storeRegistration');
    Route::delete('{evento}/{persona}', [EventoController::class, 'removeParticipant'])->name('eventos.removeParticipant');
    Route::put('{evento}/{persona}', [EventoController::class, 'updateParticipant'])->name('eventos.updateParticipant');
});

Route::prefix('personas')->group(function () {
    Route::get('create/{evento}', [EventoController::class, 'register'])->name('personas.create');
});

Route::resource('personas', PersonaController::class);
Route::post('eventos/{evento}/register', [PersonaController::class, 'store'])->name('eventos.register');
Route::post('personas', [PersonaController::class, 'store'])->name('personas.store');

// Home page
Route::get('/', [EventoController::class, 'index']);


