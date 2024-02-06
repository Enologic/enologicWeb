@extends('layouts.template')

@section('general')


    <div class="container mt-5">

        <div class="container d-flex">

            <h1 class="col-9">Products - USER</h1>

            <div class="col-3 text-end">
                {{-- Boton para volver a DASHBOARD --}}
                <a class="btn btn-dark mb-3" href="{{ 'home' }}">
                    {{ __('Back') }}
                </a>
                {{-- Boton para ir a CART --}}
                <a class="btn btn-secondary mb-3" href="{{ 'cart' }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>

        </div>
        <table class="table">
            <thead>
                <tr class="">
                    <th scope="col">Name</th>
                    {{-- <th scope="col">Description</th> --}}
                    <th scope="col">Price</th>
                    <th scope="col">Age</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Country</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="align-middle">
                        <td class="">{{ $product->product_name }}</td>
                        {{-- <td class="">{{ $product->description }}</td> --}}
                        <td class="">{{ $product->price }}€</td>
                        <td class="">{{ $product->age }} years</td>
                        <td class="">{{ $product->origin }}</td>
                        <td class="">{{ $product->country }}</td>

                        <td class="">
                            <div class="d-flex justify-content-center">

                                {{-- Botón para añadir un producto --}}
                                <a href="#addProductModal{{ $product->id }}" class="btn btn-success mx-1"
                                    data-bs-toggle="modal" data-bs-target="#addProductModal{{ $product->id }}">
                                    <i class="fa-regular fa-plus"></i>
                                </a>

                                {{-- Modal para añadir un producto --}}
                                <div class="modal fade" id="addProductModal{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="addProductModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('cart.add', ['productId' => $product->id]) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-header bg-dark text-white">
                                                    <h5 class="modal-title" id="addProductModalLabel">
                                                        {{ $product->product_name }}</h5>
                                                    <button type="button" class="btn-close bg-danger rounded-5"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex align-items-center justify-content-center">
                                                    <div class="col-4 m-0 fw-medium text-center">
                                                        Choose quantity:
                                                    </div>
                                                    <div class="col-4">
                                                        <select class="form-select" id="quantitySelect{{ $product->id }}"
                                                            name="quantity">
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="container pb-3 px-3 text-center">
                                                    {{ $product->description }}
                                                </div>
                                                <div class="modal-footer justify-content-center bg-dark">
                                                    <button type="submit" class="px-4 btn btn-success">Add</button>
                                                    <button type="button" class="px-4 btn btn-secondary"
                                                        data-bs-dismiss="modal">Back</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                        </td>

                    </tr>
                @endforeach

                <!-- Puedes agregar más filas según sea necesario -->
            </tbody>
        </table>
    </div>
@endsection
