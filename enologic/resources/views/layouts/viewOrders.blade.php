@extends('layouts.general')

@section('viewOrders')
    <div class="container mt-5">

        <div class="container d-flex">

            <h1 class="col-9">User Orders</h1>

            <div class="col-3 d-flex align-items-center justify-content-end">
                {{-- Boton para volver a PROFILE --}}
                <a class="btn btn-dark" href="{{ url('/profile') }}">
                    <i class="fa-solid fa-rotate-left"></i>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#orderModal{{ $order->id }}">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modales fuera del bucle -->
                @foreach ($orders as $order)
                    <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                {{-- MODAL HEADER --}}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order Details -
                                        {{ $order->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                {{-- MODAL BODY --}}
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->products as $product)
                                                <tr class="align-middle">
                                                    <td>{{ $product->product_name }}</td>
                                                    <td class="text-center">{{ $product->price }} €</td>
                                                    <td class="text-center">{{ $product->pivot->quantity }}</td>
                                                    <td class="text-center">
                                                        {{ $product->price * $product->pivot->quantity }} €
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- MODAL FOOTER --}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No tienes pedidos.</p>
            @endif
        </div>
    </div>

@endsection