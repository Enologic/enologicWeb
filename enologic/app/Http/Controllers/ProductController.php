<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function mostrar()
    {
        return view('layouts.add');
    }

    public function show()
    {
        $products = Product::all();
                
        return view('layouts.show', compact('products'));
    }

    public function guardarProducto(Request $request)
    {
        $request->validate([
            'productname' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'age' => 'required|integer',
            'reservation' => 'required|boolean',
        ]);

        Product::mostrar($request->all());

        return redirect()->route('add')
            ->with('success', 'Product added successfully');
    }
}
