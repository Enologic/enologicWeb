<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\WishlistController;



class ProductController extends Controller
{
    public function mostrar()
    {
        try {
            // Obtener todos los productos
            $products = Product::all();
            // Obtener los tipos de uva y tipos de vino
            $grapeTypes = Product::getGrapeTypes();

            $wineTypes = Product::getWineTypes();

            // Instanciar el controlador de Wishlist
            $wishlistController = new WishlistController();
            // Llamada al método para obtener los productos más añadidos en las listas de deseos
            $mostAddedProductsData = $wishlistController->mostAddedProductsInWishlists();

            // Verificar si se obtuvo un error al recuperar los productos más añadidos
            if (isset($mostAddedProductsData['error'])) {
                // Manejar el error adecuadamente, por ejemplo, redirigiendo con un mensaje de error
                return redirect()->back()->with('error', $mostAddedProductsData['error']);
            }

            // Obtener los productos más añadidos y el total
            $mostAddedProducts = $mostAddedProductsData['mostAddedProducts'];
            $totalMostAddedProducts = $mostAddedProductsData['totalMostAddedProducts'];

            // Pasar los productos, tipos de uva, tipos de vino y productos más añadidos a la vista
            return view('layouts.add', compact('products', 'grapeTypes', 'wineTypes', 'mostAddedProducts', 'totalMostAddedProducts'));
        } catch (\Exception $e) {
            // Manejar el error apropiadamente, por ejemplo, redirigiendo con un mensaje de error
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function show()
    {
        $products = Product::all();
        // Obtener los tipos de uva y tipos de vino
        $grapeTypes = Product::getGrapeTypes();
        $wineTypes = Product::getWineTypes();

        return view('layouts.show', compact('products',  'grapeTypes', 'wineTypes',));
    }

    public function guardarProducto(Request $request)
    {
        try {
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
            $productoNuevo->stock = $request->stock;

            // Comienza una transacción
            DB::beginTransaction();

            // Guardar el producto
            $productoNuevo->save();

            // Commit de la transacción si todo va bien
            DB::commit();

            return redirect()->route('add')->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada
            \Log::error('Error saving product: ' . $e->getMessage());
            // Rollback de la transacción en caso de error
            DB::rollback();
            return redirect()->back()->with('error', 'Error adding product: ' . $e->getMessage());
        }
    }


    // ELIMINAR EL PRODUCTO SELECCIONADO
    public function deleteProducto($id)
    {
        $product = Product::where('id', $id)->first();

        $product->forceDelete();

        return back()->with('success', 'Product deleted successfully');
    }

    // EDITAR EL PRODUCTO SELECCIONADO
    public function updateProducto(Request $request, $id)
    {
        try {
            // Iniciar una transacción
            DB::beginTransaction();

            // Lógica para actualizar el producto
            $product = Product::find($id);

            // Validación
            $request->validate([
                'product_name' => 'required',
                'grape_type' => 'required', // Asegúrate de tener estos campos en tu formulario
                'wine_type' => 'required',
            ]);

            // Almacena los datos originales del producto antes de la actualización
            $originalData = $product->toArray();

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
                'stock'        => $request->input('stock'),
            ]);

            // Commit de la transacción si no hay errores
            DB::commit();

            return back()->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            // Rollback de la transacción en caso de error
            DB::rollBack();

            // Retornar con un mensaje de error
            return back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');

        if ($category === "All Categories") {
            $products = Product::all();

            $grapeTypes = Product::getGrapeTypes();
            $wineTypes = Product::getWineTypes();
        } else {
            $products = Product::where('grape_type', $category)->get();
            // Obtener los tipos de uva y tipos de vino
            $grapeTypes = Product::getGrapeTypes();
            array_unshift($grapeTypes, 'All Categories');
            $grapeTypes = array_diff($grapeTypes, [$category]);


            $wineTypes = Product::getWineTypes();
            array_unshift($wineTypes, 'All Categories');
            $wineTypes = array_diff($wineTypes, [$category]);
        }



        return view('layouts.show', compact('products', 'grapeTypes', 'wineTypes', 'category'));
    }

    public function getStock(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return (int) $product->stock;
    }
}
