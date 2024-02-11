@extends('layouts.template')

@section('general')
    {{-- HEADER --}}
    <nav>
    </nav>

    {{-- Vista principal --}}
    {{-- Aquí irán todos los yields de las vistas que tengamos. --}}
    <table class="table">
    <thead>
        <tr class="">
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Age</th>
            <th scope="col">Origin</th>
            <th scope="col">Country</th>
            <th scope="col">Grape Type</th>
            <th scope="col">Wine Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr class="align-middle">
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}€</td>
            <td>{{ $product->age }} years</td>
            <td>{{ $product->origin }}</td>
            <td>{{ $product->country }}</td>
            <td>{{ $product->grape_type }}</td>
            <td>{{ $product->wine_type }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

    {{-- FOOTER --}}
    <footer>
    </footer>
@endsection
