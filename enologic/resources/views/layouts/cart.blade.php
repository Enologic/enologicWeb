@extends('layouts.template')

@section('general')
    {{-- HEADER --}}
    <nav>
    </nav>

    {{-- Vista principal --}}
    {{-- Aquí irán todos los yields de las vistas que tengamos. --}}

    <div class="container mt-5">
        <div class="container d-flex">

            <h1 class="col-9 mb-0">Shopping cart - USER</h1>

            <div class="col-3 d-flex justify-content-end align-items-center">
                {{-- Boton para volver a DASHBOARD --}}
                <a class="btn btn-dark" href="{{ 'show' }}">
                    {{ __('Back') }}
                </a>
            </div>

        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="align-middle">
                        <td>{{ $product->product_name }}</td>
                        <td class="text-center">{{ $product->price }} €</td>
                        <td class="text-center">{{ $product->pivot->quantity }}</td>
                        <td class="text-center">{{ $product->price * $product->pivot->quantity }} €</td>
                        <td><a href="#deleteModal{{ $product->id }}" id="img-style-size" class="btn btn-danger mx-1"
                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </a></td>
                    </tr>
                    {{-- Modal para eliminar un producto del carrito --}}
                    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Remove from cart</h5>
                                    <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body mt-2 text-center">
                                    <p class="m-0 fw-medium">Do you want to remove from cart this product?
                                    </p>
                                    <p class="fw-bolder mt-3">{{ $product->product_name }}</p>
                                    <p class="mt-3"><span class="fw-medium">x{{ $product->pivot->quantity }}</span> Units
                                    </p>
                                </div>
                                <div class="bg-dark modal-footer justify-content-center">
                                    <form action="{{ route('delete.producto', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-3">
            <h5>Total:
                {{ $products->sum(function ($product) {return $product->price * $product->pivot->quantity;}) }} €
            </h5>
            {{-- Botón para añadir un producto --}}
            <div class="mt-3">
                <div class="d-inline-block">
                    <a href="#" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#sendOrderModal">
                        Send order
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal para confirmar un pedido --}}
<div class="modal fade" id="sendOrderModal" tabindex="-1" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="addProductModalLabel">Confirm order</h5>
                <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('confirmar.pedido') }}" method="POST">
                    @csrf

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="align-middle">
                                    <td>{{ $product->product_name }}</td>
                                    <td class="text-center">{{ $product->price }} €</td>
                                    <td class="text-center">{{ $product->pivot->quantity }}</td>
                                    <td class="text-center">{{ $product->price * $product->pivot->quantity }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h5 class="text-end">Total:
                        {{ $products->sum(function ($product) {return $product->price * $product->pivot->quantity;}) }} €
                    </h5>

                    <div class="modal-footer justify-content-center bg-dark">
                        <button type="submit" class="btn btn-success">Confirm order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    {{-- FOOTER --}}
    <footer>
    </footer>
@endsection
