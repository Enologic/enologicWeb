<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{

    public function viewCart(){
        try {
            DB::beginTransaction();
    
            $user = Auth::user();
    
            $cart = Cart::with('products')->where('user_id', $user->id)->first();
    
            if (!$cart) {

                DB::rollBack();
                return redirect()->route('show')->with('error', 'No se encontró el carrito del usuario.');
            }
    
            $products = $cart->products;
    
            DB::commit();
    
            return view('layouts.cart', compact('products'));
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->route('show')->with('error', 'Error al cargar el carrito: ' . $e->getMessage());
        }
    }

    public function addToCart(Request $request, $productId){
    try {
        DB::beginTransaction();

        $user = Auth::user();

        $cart = $user->cart ?? Cart::create(['user_id' => $user->id]);

        $product = Product::findOrFail($productId);

        $quantity = $request->input('quantity', 1);

        if ($cart->products->contains($product)) {

            $pivotRow = $cart->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->quantity += $quantity;
            $pivotRow->save();
        } else {

            $cart->products()->attach($product, ['quantity' => $quantity]);
        }

        DB::commit();

        return redirect()->route('show')->with('success', 'Product added successfully');
    } catch (\Exception $e) {

        DB::rollBack();
        return redirect()->route('show')->with('error', 'Error adding product to cart: ' . $e->getMessage());
    }
}


public function deleteProduct($productId)
{
    try {
        DB::beginTransaction();

        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return redirect()->route('home')->with('error', 'No se encontró el carrito del usuario.');
        }

        $cart->products()->detach($productId);

        DB::commit();

        return back()->with('success', 'Product deleted successfully');
    } catch (\Exception $e) {

        DB::rollBack();
        return back()->with('error', 'Error deleting product: ' . $e->getMessage());
    }
}
public function increaseQuantity($productId){
    try {
        DB::beginTransaction();

        $user = Auth::user();

        $cart = $user->cart ?? Cart::create(['user_id' => $user->id]);

        $product = Product::findOrFail($productId);

        if ($cart->products->contains($product)) {

            $pivotRow = $cart->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->quantity += 1;
            $pivotRow->save();
        } else {

            $cart->products()->attach($product, ['quantity' => 1]);
        }

        $total = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        DB::commit();

        return response()->json(['success' => true, 'total' => $total]);
    } catch (\Exception $e) {

        DB::rollBack();
        return response()->json(['success' => false, 'message' => 'Error increasing product quantity: ' . $e->getMessage()], 500);
    }
}

public function decreaseQuantity($productId)
{
    try {
        DB::beginTransaction();

        $user = Auth::user();

        $cart = $user->cart;


        if ($cart && $cart->products->contains($productId)) {

            $currentQuantity = $cart->products()->where('product_id', $productId)->first()->pivot->quantity;

            if ($currentQuantity > 1) {

                $cart->products()->updateExistingPivot($productId, ['quantity' => $currentQuantity - 1]);
            } else {
              
                throw new \Exception('La cantidad del producto ya es mínima.');
            }
        } else {
          
            throw new \Exception('El producto no está en el carrito.');
        }

        $total = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        DB::commit();

        return response()->json(['success' => true, 'total' => $total]);
    } catch (\Exception $e) {

        DB::rollBack();
        return response()->json(['success' => false, 'message' => 'Error decreasing product quantity: ' . $e->getMessage()], 500);
    }
}
}
