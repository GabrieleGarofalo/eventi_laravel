<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PersonaController;

// Route per gli eventi
Route::prefix('eventos')->group(function () {
    Route::get('/', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('{evento}', [EventoController::class, 'show'])->name('eventos.show');
    Route::get('{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');

    Route::post('{evento}/register', [PersonaController::class, 'store'])->name('eventos.register');
});

// Route per le persone
Route::prefix('personas')->group(function () {
    Route::post('/', [PersonaController::class, 'store'])->name('personas.store');
    Route::get('create/{evento}', [EventoController::class, 'register'])->name('personas.create');
    Route::get('/', [PersonaController::class, 'index'])->name('personas.index');
    Route::get('create', [PersonaController::class, 'create'])->name('personas.create');
    Route::get('{persona}', [PersonaController::class, 'show'])->name('personas.show');
    Route::get('{persona}/edit', [PersonaController::class, 'edit'])->name('personas.edit');
    Route::put('{persona}', [PersonaController::class, 'update'])->name('personas.update');
    Route::delete('{persona}', [PersonaController::class, 'destroy'])->name('personas.destroy');
});

// Home page
Route::get('/', [EventoController::class, 'index']);


