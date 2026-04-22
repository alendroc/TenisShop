<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ZapatoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TallaZapatoController;
use App\Http\Controllers\ImagenZapatoController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [CategoriaController::class, 'index'])->name('home');

// Categorías (lectura pública)
Route::get('/categorias',            [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/{categoria}',[CategoriaController::class, 'show']) ->name('categorias.show');

// Productos (lectura pública)
Route::get('/productos/{zapato}',    [ZapatoController::class, 'show'])    ->name('productos.show');

// Búsqueda global
Route::get('/buscar',                [ZapatoController::class, 'buscar'])  ->name('buscar');

/*
|--------------------------------------------------------------------------
| Rutas Admin (descomentar cuando implementes autenticación)
|--------------------------------------------------------------------------
*/
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // CRUD Categorías
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('categorias', CategoriaController::class)
            ->except(['index', 'show']);

        // CRUD Zapatos
        Route::resource('zapatos', ZapatoController::class);

        // CRUD Marcas
        Route::resource('marcas', MarcaController::class);

        // Tallas de un zapato
        Route::post('zapatos/{zapato}/tallas',  [TallaZapatoController::class, 'store']) ->name('tallas.store');
        Route::put('tallas/{talla}',            [TallaZapatoController::class, 'update'])->name('tallas.update');
        Route::delete('tallas/{talla}',         [TallaZapatoController::class, 'destroy'])->name('tallas.destroy');

        // Imágenes de un zapato
        Route::post('zapatos/{zapato}/imagenes', [ImagenZapatoController::class, 'store'])  ->name('imagenes.store');
        Route::put('imagenes/{imagen}',          [ImagenZapatoController::class, 'update']) ->name('imagenes.update');
        Route::delete('imagenes/{imagen}',       [ImagenZapatoController::class, 'destroy'])->name('imagenes.destroy');
    });

// });