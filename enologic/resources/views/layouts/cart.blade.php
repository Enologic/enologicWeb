@extends('layouts.template')

@section('general')
    {{-- HEADER --}}
    <nav>
    </nav>

    {{-- Vista principal --}}
    {{-- Aquí irán todos los yields de las vistas que tengamos. --}}
   
        <div class="container mt-4">
            <h2>Carrito de Compras</h2>

            <table class="table mt-3">
    <thead>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }} €</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->price * $product->pivot->quantity }} €</td>
                <td><a href="#deleteModal{{ $product->id }}" id="img-style-size" class="btn btn-danger mx-1"
                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                        <i class="fa-solid fa-trash"></i>
                    </a></td>
            </tr>
            {{-- Modal para eliminar un producto del carrito --}}
<div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Producto del Carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="m-0 fw-medium">¿Estás seguro de que quieres eliminar
                    <span class="fw-bolder">{{ $product->product_name }}</span> del carrito?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <form action="{{ route('delete.producto', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

        @endforeach
    </tbody>
</table>

<div class="text-end mt-3">
    <h5>Precio Total: {{ $products->sum(function ($product) { return $product->price * $product->pivot->quantity; }) }} €</h5>
</div>
        </div>
 
    
    {{-- FOOTER --}}
    <footer>
    </footer>
@endsection
