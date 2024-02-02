<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function mostrar()
    {
        $products = Product::all();

        return view('layouts.add', compact('products'));
    }

    public function show()
    {
        $products = Product::all();

        return view('layouts.show', compact('products'));
    }

    public function guardarProducto(Request $request)
    {
        // Validación
        $request->validate([
            'product_name' => 'required',
        ]);

        // Crear un nuevo producto y asignar los valores
        $productoNuevo = new Product;
        $productoNuevo->product_name = $request->product_name;
        $productoNuevo->description = $request->description;
        $productoNuevo->price = $request->price;
        $productoNuevo->age = $request->age;
        $productoNuevo->origin = $request->origin;
        $productoNuevo->country = $request->country;

        // Guardar el producto
        $productoNuevo->save();

        return redirect()->route('add')
            ->with('success', 'Product added successfully');
    }

    // ELIMINAR EL Producto SELECCIONADO
    public function deleteProducto($id){
        $product = Product::where('id', $id)->first();

        $product->forceDelete();

        return back()->with('success', 'Product deleted successfully');
    }


}
