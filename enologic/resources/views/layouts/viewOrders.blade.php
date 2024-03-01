@extends('layouts.general')

@section('viewOrders')

<div class="container mt-3">

    <h1 class="text-center pb-1"><span class="rounded-pill title-custom px-3">My orders</span></h1>
    <div class="container d-flex align-items-center justify-content-between">
        <div class="col-12 text-end">
            {{-- Boton para volver a PROFILE --}}
            <a class="btn btn-dark" href="{{ url('/profile') }}">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
            {{-- Botón WISHLIST --}}
            <a class="btn btn-dark" href="{{ url('/wishlist') }}">
                <i class="fa-solid fa-heart"></i>
            </a>
        </div>
    </div>

    <div class="container">
        @if (isset($orders) && count($orders) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>View Order</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                            View Details
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modales fuera del bucle -->
        @foreach ($orders as $order)
        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order Details -
                            {{ $order->id }}
                        </h5>
                        <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                <tr class="align-middle">
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }} €</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->price * $product->pivot->quantity }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($order->total_discounted != $order->total)
                        <h5 class="text-end">
                            Total:
                            <del style="color: black;">{{ $order->total }} €</del>
                            <span style="color: red;">{{ $order->total_discounted }} €</span>
                        </h5>
                        <p style="color: green;">Discount applied</p>
                        @else
                        <h5 class="text-end">Total: {{ $order->total }} €</h5>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-center bg-dark">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="mt-3 text-center custom-view-orders">No tienes pedidos.</p>
        @endif
    </div>
</div>

@endsection