@extends('layouts.general')

@section('cart')
    <script>
        let increaseUrl = "{{ route('cart.increase', '?') }}";
        let decreaseUrl = "{{ route('cart.decrease', '?') }}";
        let stockUrl = "{{ route('product.stock', ['id' => ':id']) }}";
    </script>

    <div class="container mt-3">

        <h1 class="text-center pb-1"><span class="rounded-pill title-custom px-3">Shopping cart</span></h1>
        <div class="container d-flex align-items-center justify-content-between">

            <div class="col-12 text-end pe-4 mb-3">
                {{-- Boton para volver a DASHBOARD --}}
                <a class="btn btn-dark" href="{{ 'show' }}">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </div>

        <table class="table mb-3">
            <thead>
                <tr class="custom-th">
                    <th scope="col">Name</th>
                    <th scope="col" class="text-center">Price(€)</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Subotal(€)</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="align-middle custom-td">
                        <td>{{ $product->product_name }}</td>
                        <td class="text-center price">{{ $product->price }}</td>
                        <td class="text-center">
                            <div class="input-group">
                                <!-- Botón de disminución -->
                                <button class="btn btn-outline-secondary decrease" type="button"
                                    data-product-id="{{ $product->id }}">-</button>
                                <!-- Cantidad actual -->
                                <input id="cart-input-custom" type="text" class="form-control text-center quantity"
                                    value="{{ $product->pivot->quantity }}" readonly>
                                <!-- Botón de aumento -->
                                <button class="btn btn-outline-secondary increase" type="button"
                                    data-product-id="{{ $product->id }}">+</button>
                            </div>
                        </td>
                        <td class="text-center subtotal">{{ $product->price * $product->pivot->quantity }}</td>
                        {{-- Botón para eliminar un producto del cart --}}
                        <td class="text-center"><a href="#deleteModal{{ $product->id }}" id="img-style-size"
                                class="btn btn-danger mx-1" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $product->id }}">
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
                                {{-- IMG DE PRUEBA --}}
                                <div class="container product-img-custom mt-3"></div>
                                <div class="modal-body d-flex align-items-center justify-content-center">
                                    <div class="col-12 fw-medium text-center">
                                        <h5 class="fst-italic">{{ $product->product_name }}</h5>
                                    </div>
                                </div>
                                <div class="container pb-3 px-3 text-center">
                                    <div class="container d-flex justify-content-evenly mb-3">
                                        <span
                                            class="badge bg-warning text-dark rounded-pill fs-6">{{ $product->origin }}</span>
                                        <span
                                            class="badge bg-info text-white rounded-pill fs-6">{{ $product->grape_type }}</span>
                                    </div>
                                    {{ $product->description }}
                                    <div class="mt-3">
                                        <span id="quantityDeleteModal{{ $product->id }}"
                                            class="fw-medium quantity-modal">x{{ $product->pivot->quantity }}</span> Units
                                    </div>
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

        <div class="my-3 d-flex justify-content-between">

            <h5 id="total" class="cart-total-custom mt-1 text-center rounded-5 col-4">Total:
                {{ $products->sum(function ($product) {return $product->price * $product->pivot->quantity;}) }}€
            </h5>

            {{-- Botón para finalizar compra e ir a checkout --}}

            @if ($products->sum('pivot.quantity') > 0)
                <a href="#" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#sendOrderModal">
                    Send order
                </a>
            @else
                <button class="btn btn-success mx-1" disabled>Send order</button>
            @endif

        </div>
    </div>

    {{-- Modal para confirmar un pedido --}}
    <div class="modal fade" id="sendOrderModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addProductModalLabel">Confirm order</h5>
                    <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Price(€)</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Subtotal(€)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="align-middle">
                                    <td>{{ $product->product_name }}</td>
                                    <td class="text-center">{{ $product->price }}</td>
                                    <td id="quantityModal{{ $product->id }}" class="text-center">
                                        {{ $product->pivot->quantity }}</td>
                                    <td id="subtotalModal{{ $product->id }}" class="text-center">
                                        {{ $product->price * $product->pivot->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h5 class="text-end" id="total">Total:
                        {{ $products->sum(function ($product) {return $product->price * $product->pivot->quantity;}) }}€
                    </h5>
                </div>
                <div class="modal-footer justify-content-center bg-dark">
                    @if ($products->sum('pivot.quantity') > 0)
                        <a href="{{ 'order' }}" type="submit" class="btn btn-success">Checkout</a>
                    @else
                        <button class="btn btn-success" disabled>Checkout</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
