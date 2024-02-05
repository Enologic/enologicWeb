<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario tiene un carrito o crear uno nuevo
        $cart = $user->cart ?? Cart::create(['user_id' => $user->id]);

        // Obtener el producto que se va a agregar al carrito
        $product = Product::findOrFail($productId);

        // Obtener la cantidad seleccionada desde el formulario
        $quantity = $request->input('quantity', 1);

        // Verificar si el producto ya está en el carrito
        if ($cart->products->contains($product)) {
            // Incrementar la cantidad si el producto ya está en el carrito
            $pivotRow = $cart->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->quantity += $quantity;
            $pivotRow->save();
        } else {
            // Agregar el producto al carrito con la cantidad seleccionada
            $cart->products()->attach($product, ['quantity' => $quantity]);
        }

        return redirect()->route('show')
        ->with('success', 'Product added successfully');    }
}
