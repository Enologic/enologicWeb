<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        // Aquí deberías implementar la lógica para agregar el producto al carrito.
        // Puedes almacenar la información en la sesión, en una base de datos, o en cualquier otro lugar que elijas.

        // Ejemplo de almacenamiento en sesión (puedes adaptarlo según tus necesidades):
        $cart = session('cart', []);
        $cart[$productId] = $quantity;
        session(['cart' => $cart]);

        return redirect()->route('show')->with('success', 'Producto añadido al carrito');
    }
}
