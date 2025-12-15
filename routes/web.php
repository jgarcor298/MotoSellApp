<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\MotoController;

Route::get('/', [MotoController::class, 'index'])->name('home');

Auth::routes();

// Rutas protegidas para administración
// Rutas protegidas para administración
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('marcas', MarcaController::class);
    Route::resource('modelos', ModeloController::class);
    Route::resource('tipos', TipoController::class);
    
    // Todas las acciones de motos excepto index y show requieren auth (pero la lógica de admin/owner está en el controlador)
    // Route::resource('motos', MotoController::class)->except(['index', 'show']); // MOVED
});

// Rutas autenticadas generales (Clientes y Admin)
Route::middleware(['auth'])->group(function () {
    // Favoritos
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/motos/{moto}/favorite', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
    
    // Gestión de motos (Crear, Editar, Eliminar) - Controlado por política en controlador
    Route::resource('motos', MotoController::class)->except(['index', 'show']);
});

// Rutas públicas de motos
Route::get('motos', [MotoController::class, 'index'])->name('motos.index');
Route::get('motos/{moto}', [MotoController::class, 'show'])->name('motos.show');
Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
