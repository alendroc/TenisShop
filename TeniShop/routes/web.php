<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ZapatoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TallaZapatoController;
use App\Http\Controllers\ImagenZapatoController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categorias',            [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/{categoria}',[CategoriaController::class, 'show']) ->name('categorias.show');

Route::get('/productos/{zapato}',    [ZapatoController::class, 'show'])    ->name('productos.show');

Route::get('/buscar',                [ZapatoController::class, 'buscar'])  ->name('buscar');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('categorias', CategoriaController::class)
        ->except(['index', 'show']);


    Route::resource('zapatos', ZapatoController::class)
        ->except(['index']); 

    Route::get('zapatos', [ZapatoController::class, 'adminIndex'])
        ->name('zapatos.index'); 

    Route::resource('marcas', MarcaController::class);

    Route::post('zapatos/{zapato}/tallas',   [TallaZapatoController::class, 'store'])  ->name('tallas.store');
    Route::put('tallas/{talla}',             [TallaZapatoController::class, 'update']) ->name('tallas.update');
    Route::delete('tallas/{talla}',          [TallaZapatoController::class, 'destroy'])->name('tallas.destroy');

    Route::post('zapatos/{zapato}/imagenes', [ImagenZapatoController::class, 'store'])  ->name('imagenes.store');
    Route::put('imagenes/{imagen}',          [ImagenZapatoController::class, 'update']) ->name('imagenes.update');
    Route::delete('imagenes/{imagen}',       [ImagenZapatoController::class, 'destroy'])->name('imagenes.destroy');
});