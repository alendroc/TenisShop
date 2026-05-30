<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ZapatoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TallaZapatoController;
use App\Http\Controllers\ImagenZapatoController;
use App\Http\Controllers\HomeController;

// Públicas
Route::get('/home',                    [HomeController::class,     'index']);
Route::get('/categorias',              [CategoriaController::class,'index']);
Route::get('/categorias/{categoria}',  [CategoriaController::class,'show']);
Route::get('/productos/{zapato}',      [ZapatoController::class,   'show']);
Route::get('/buscar',                  [ZapatoController::class,   'buscar']);

// Admin
Route::prefix('admin')->group(function () {
    Route::resource('categorias', CategoriaController::class)->except(['index','show']);
    Route::resource('zapatos',    ZapatoController::class)->except(['index']);
    Route::get('zapatos',         [ZapatoController::class,'adminIndex']);
    Route::resource('marcas',     MarcaController::class);

    Route::post('zapatos/{zapato}/tallas',   [TallaZapatoController::class, 'store']);
    Route::put('tallas/{talla}',             [TallaZapatoController::class, 'update']);
    Route::delete('tallas/{talla}',          [TallaZapatoController::class, 'destroy']);

    Route::post('zapatos/{zapato}/imagenes', [ImagenZapatoController::class, 'store']);
    Route::put('imagenes/{imagen}',          [ImagenZapatoController::class, 'update']);
    Route::delete('imagenes/{imagen}',       [ImagenZapatoController::class, 'destroy']);
});