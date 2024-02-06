<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use App\Http\Controllers\AddressController; 

class OrderController extends Controller
{

public function confirmOrder(Request $request)
{
    try {
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

        // Enviar Order al correo
        Mail::to($order->user->email)->send(new OrderConfirmation($order));

        // Llamar al método saveAddress del controlador AddressController
        $addressController = new AddressController();
        $addressController->saveAddress($request);

   // Retorna a la página del carrito
   return redirect()->route('viewCart')->with('success', 'Order added successfully');
    } catch (\Exception $e) {
        // Manejar cualquier excepción capturada
        \Log::error('Error confirming order: ' . $e->getMessage());
        echo ($e->getMessage());
    }
}


    public function viewCheckout()
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

        return view('layouts.checkout', compact('products'));
    }
}

