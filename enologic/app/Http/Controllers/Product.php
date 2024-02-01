<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Product extends Controller
{
    public function mostrar()
    {
        return view('layouts.add');
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
