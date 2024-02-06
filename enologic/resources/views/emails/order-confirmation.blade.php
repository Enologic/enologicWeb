@extends('layouts.template')

@section('general')
    {{-- HEADER --}}
    <nav>
    </nav>

    <div class="container mt-4">
        <h2>Order Details</h2>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Quantity</th>
                    <th scope="col" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr class="align-middle">
                        <td>{{ $product->product_name }}</td>
                        <td class="text-center">{{ $product->price }} €</td>
                        <td class="text-center">{{ $product->pivot->quantity }}</td>
                        <td class="text-center">{{ $product->price * $product->pivot->quantity }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-3">
            <h5>Total:
                {{ $order->products->sum(function ($product) { return $product->price * $product->pivot->quantity; }) }} €
            </h5>
        </div>
    </div>

    <footer>
    </footer>
@endsection
