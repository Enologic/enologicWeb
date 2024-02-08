<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function mostrar()
    {
        $products = Product::all();
        $grapeTypes = Product::getGrapeTypes();
        $wineTypes = Product::getWineTypes();

        return view('layouts.add', compact('products', 'grapeTypes', 'wineTypes'));
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
            'grape_type' => 'required', // Asegúrate de tener estos campos en tu formulario
            'wine_type' => 'required',
        ]);

        // Crear un nuevo producto y asignar los valores
        $productoNuevo = new Product;
        $productoNuevo->product_name = $request->product_name;
        $productoNuevo->description = $request->description;
        $productoNuevo->price = $request->price;
        $productoNuevo->age = $request->age;
        $productoNuevo->origin = $request->origin;
        $productoNuevo->country = $request->country;
        $productoNuevo->grape_type = $request->grape_type; // Asignar el valor del enum grape_type
        $productoNuevo->wine_type = $request->wine_type; // Asignar el valor del enum wine_type

        // Guardar el producto
        $productoNuevo->save();

        return redirect()->route('add')
            ->with('success', 'Product added successfully');
    }


    // ELIMINAR EL Producto SELECCIONADO
    public function deleteProducto($id)
    {
        $product = Product::where('id', $id)->first();

        $product->forceDelete();

        return back()->with('success', 'Product deleted successfully');
    }

    public function updateProducto(Request $request, $id)
    {
        // Lógica para actualizar el producto
        $product = Product::find($id);

        // Validación
        $request->validate([
            'product_name' => 'required',
            'grape_type' => 'required', // Asegúrate de tener estos campos en tu formulario
            'wine_type' => 'required',
        ]);

        // Actualiza los campos del producto con los datos del formulario
        $product->update([
            'product_name' => $request->input('product_name'),
            'description'  => $request->input('description'),
            'price'        => $request->input('price'),
            'age'          => $request->input('age'),
            'origin'       => $request->input('origin'),
            'country'      => $request->input('country'),
            'grape_type'   => $request->input('grape_type'), // Actualiza el campo grape_type
            'wine_type'    => $request->input('wine_type'), // Actualiza el campo wine_type
        ]);

        return back()->with('success', 'Product updated successfully');
    }
}
