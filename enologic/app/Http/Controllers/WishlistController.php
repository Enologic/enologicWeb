<?php

namespace App\Http\Controllers;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
   
    public function viewWishlist()
{
    try {
        $user = Auth::user();

        $wishlists = Wishlist::with('products')->where('user_id', $user->id)->get();

        $products = collect(); // Inicializamos una colección vacía para almacenar los productos

        foreach ($wishlists as $wishlist) {
            $products = $products->merge($wishlist->products); // Agregamos los productos de cada lista de deseos a la colección
        }

        return view('layouts.wishlist', compact('products'));
    } catch (\Exception $e) {
        // Maneja adecuadamente la excepción, por ejemplo, mostrando un mensaje de error
        return view('layouts.wishlist')->with('error', 'Error al cargar la lista de deseos: ' . $e->getMessage());
    }
}


    
   
public function addToWishlist(Request $request, $productId){
    try {
        $user = Auth::user();

        if ($user->wishlist) {
            $wishlist = $user->wishlist;
        } else {
            $wishlist = Wishlist::create(['user_id' => $user->id]);
        }

        $product = Product::findOrFail($productId);

        if ($wishlist->products->contains($product)) {
            return back()->with('error', 'Product already exists in wishlist');
        } else {
            // Agregar el producto a la lista de deseos
            $wishlist->products()->attach($product);
            return back()->with('success', 'Product added to wishlist successfully');
        }
    } catch (\Exception $e) {
        return back()->with('error', 'Error adding product to wishlist: ' . $e->getMessage());
    }
}

    
    public function removeFromWishlist($productId){
    try {
        DB::beginTransaction();

        $user = Auth::user();

        $wishlist = Wishlist::where('user_id', $user->id)->first();

        if (!$wishlist) {
            return redirect()->route('show')->with('error', 'No se encontró la lista de deseos del usuario.');
        }

        $wishlist->products()->detach($productId);

        DB::commit();

        return back()->with('success', 'Product removed from wishlist successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error removing product from wishlist: ' . $e->getMessage());
    }
}

public function mostAddedProductsInWishlists()
{
    try {
        // Obtener los productos más añadidos en las listas de deseos
        $mostAddedProducts = DB::table('product_wishlist')
            ->select('product_id', DB::raw('COUNT(*) as total'))
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->limit(3) // Limitar a los 10 productos más añadidos, por ejemplo
            ->get();

        // Obtener los detalles de los productos más añadidos
        $productIds = $mostAddedProducts->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        // Devolver los productos más añadidos y el total
        return [
            'mostAddedProducts' => $mostAddedProducts,
            'totalMostAddedProducts' => $mostAddedProducts->count(),
        ];
    } catch (\Exception $e) {
        // Manejar el error adecuadamente
        return [
            'error' => 'Error retrieving most added products: ' . $e->getMessage(),
        ];
    }
}



   
}