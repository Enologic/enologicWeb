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

    public function updateProducto(Request $request, $id)
{
    // Lógica para actualizar el producto

    $product = Product::find($id);

    // Actualiza los campos del producto con los datos del formulario
    $product->update([
        'product_name' => $request->input('product_name'),
        'description'  => $request->input('description'),
        'price'        => $request->input('price'),
        'age'          => $request->input('age'),
        'origin'       => $request->input('origin'),
        'country'      => $request->input('country'),
    ]);

    return back()->with('success', 'Product updated successfully');
}



}
