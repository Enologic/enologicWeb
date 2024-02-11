<?php

namespace App\Http\Controllers;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $productId)
    {
        $user = Auth::user();

        $wishlist = $user->wishlist ?? Wishlist::create(['user_id' => $user->id]);

        $product = Product::findOrFail($productId);

        if ($wishlist->products->contains($product)) {
            return back()->with('error', 'Product already exists in wishlist');
        } else {
            // Agregar el producto a la lista de deseos
            $wishlist->products()->attach($product);
            return back()->with('success', 'Product added to wishlist successfully');
        }
    }
}
