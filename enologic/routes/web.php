<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

// RUTA INICIAL
Route::get('/', function () {
    return view('auth/login');
});

// RUTA INICIAL SI ESTA VERIFICADO/LOGGED
Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware(['auth', 'verified']);


// RUTAS AUTH
Route::prefix('')->middleware('auth', 'verified')->group(function () {

    Route::get('add', [ProductController::class, 'mostrar'])->name('add');

    Route::post('guardar-producto', [ProductController::class, 'guardarProducto'])->name('guardar.producto');

    Route::post('delete-producto/{id}', [ProductController::class, 'deleteProducto'])->name('delete.producto');

    Route::get('show', [ProductController::class, 'show'])->name('show');
});
