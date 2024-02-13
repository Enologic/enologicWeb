@extends('layouts.template')

@section('general')
    <div class="container mt-5">
        <h1>User Orders</h1>

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

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tienes pedidos.</p>
        @endif
    </div>
@endsection
