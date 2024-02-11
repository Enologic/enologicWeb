<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
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

// RUTAS A LA QUE SOLO PUEDE ACCEDER EL ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    // ADMIN - AÑADIR PRODUCTOS A LA BB.DD.
    Route::get('add', [ProductController::class, 'mostrar'])->name('add');

    Route::post('guardar-producto', [ProductController::class, 'guardarProducto'])->name('guardar.producto');

    Route::post('delete-producto/{id}', [ProductController::class, 'deleteProducto'])->name('delete.producto');

    Route::put('update-producto/{id}', [ProductController::class, 'updateProducto'])->name('update.producto');
});


// RUTAS AUTH
Route::prefix('')->middleware('auth', 'verified')->group(function () {


    // USER - VER PRODUCTOS DISPONIBLES
    Route::get('show', [ProductController::class, 'show'])->name('show');

    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');

    Route::get('cart', [CartController::class, 'viewCart'])->name('viewCart');

    Route::delete('/delete-producto/{id}', [CartController::class, 'deleteProduct'])->name('delete.producto');

    Route::post('/confirmar-pedido', [OrderController::class, 'confirmOrder'])->name('confirmar.pedido');

    Route::get('order', [OrderController::class, 'viewCheckout'])->name('viewCheckout');

    Route::post('/cart/increase/{productId}', [CartController::class, 'increaseQuantity'])->name('cart.increase');

    Route::post('/cart/decrease/{productId}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');


});
