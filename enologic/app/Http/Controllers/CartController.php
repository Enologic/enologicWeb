<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function viewCart()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener el carrito del usuario con sus productos
        $cart = Cart::with('products')->where('user_id', $user->id)->first();
    
        // Verificar si el carrito existe
        if (!$cart) {
            // Puedes manejar la lógica si el usuario no tiene un carrito, por ejemplo, redireccionar a una página de mensajes
            return redirect()->route('show')->with('error', 'No se encontró el carrito del usuario.');
        }
    
        // Obtener los productos asociados al carrito
        $products = $cart->products;
    
        return view('layouts.cart', compact('products'));
    }

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


        
public function deleteProduct($productId)
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Obtener el carrito del usuario con sus productos
    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        return redirect()->route('home')->with('error', 'No se encontró el carrito del usuario.');
    }

    // Eliminar el producto del carrito
    $cart->products()->detach($productId);

    return back()->with('success', 'Product deleted successfully');

    //Update para merge (Olga esto no es para inflar commits)
}
}
