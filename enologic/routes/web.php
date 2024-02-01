<?php

use App\Http\Controllers\Product;
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


Route::get('add', [Product::class, 'mostrar'])->name('add');

Route::post('guardar-producto', [Product::class, 'guardarProducto'])->name('guardar.producto');

Route::get('show', [Product::class, 'show'])->name('show');