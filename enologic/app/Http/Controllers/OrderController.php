<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirmOrder()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener los productos en el carrito
        $productsInCart = $user->cart->products;
    
        // Crear una nueva orden para el usuario
        $order = Order::create(['user_id' => $user->id]);
    
        // Asociar los productos a la orden y obtener la cantidad del carrito
        foreach ($productsInCart as $product) {
            $quantity = $product->pivot->quantity;
    
            // Asociar el producto a la orden con la cantidad
            $order->products()->attach($product, ['quantity' => $quantity]);
        }
    
        // Eliminar los productos del carrito
        $user->cart->products()->detach($productsInCart);
    
        return back()->with('success', 'Order added successfully');
    }
    
}

