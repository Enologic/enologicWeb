@extends('layouts.template')

@section('general')
<div class="container mt-5">
    <h1>Tabla Productos</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Age</th>
                <th scope="col">Origin</th>
                <th scope="col">Country</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($products as $product)
           <tr>
                <td>{{$product->product_name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->age}}</td>
                <td>{{$product->origin}}</td>
                <td>{{$product->country}}</td>
            </tr>
        @endforeach
          
            <!-- Puedes agregar más filas según sea necesario -->
        </tbody>
    </table>
</div>

@endsection
