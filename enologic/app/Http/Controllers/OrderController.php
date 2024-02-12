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
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    public function confirmOrder(Request $request){
        try {

            DB::beginTransaction();

            $user = Auth::user();

            $productsInCart = $user->cart->products;

            $order = Order::create(['user_id' => $user->id]);

            foreach ($productsInCart as $product) {
                $quantity = $product->pivot->quantity;

                $order->products()->attach($product, ['quantity' => $quantity]);
            }

            $user->cart->products()->detach($productsInCart);

            // Mail::to($order->user->email)->send(new OrderConfirmation($order));

            $addressController = new AddressController();
            $addressController->saveAddress($request);

            DB::commit();

            return redirect()->route('show')->with('success', 'Order added successfully');
        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Error confirming order: ' . $e->getMessage());
            return redirect()->route('show')->with('error', 'Error confirming order: ' . $e->getMessage());
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

    public function viewUserOrders()
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Verificar si el usuario está autenticado
    if ($user) {
        // Obtener todos los pedidos del usuario
        $userOrders = Order::where('user_id', $user->id)->get();

        // Pasar los pedidos a la vista
        return view('layouts.show')->with('userOrders', $userOrders);
    } else {
        // Manejar el caso en el que el usuario no está autenticado
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus pedidos.');
    }
}

}
