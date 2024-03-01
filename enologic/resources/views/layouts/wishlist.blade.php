@extends('layouts.general')

@section('wishlist')
    <div class="container mt-3">

        <h1 class="text-center pb-1"><span class="rounded-pill title-custom px-3">Wishlist</span></h1>
        <div class="container d-flex align-items-center justify-content-between">

            <div class="col-12 text-end mb-3">
                {{-- Boton para volver a SHOW --}}
                <a class="btn btn-dark" href="{{ url('/show') }}">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                {{-- Botón PROFILE --}}
                <a class="btn btn-dark custom-alert" href="{{ url('/profile') }}">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </div>

        <table class="table mb-3">
            <thead>
                <tr class="custom-th">
                    <th scope="col">Name</th>
                    {{-- <th scope="col">Description</th> --}}
                    <th scope="col">Price(€)</th>
                    <th scope="col">Age(y)</th>
                    <th scope="col" class="text-center">Country</th>
                    {{-- <th scope="col" class="text-center">Origin</th> --}}
                    {{-- <th scope="col" class="text-center">Grape</th> --}}
                    <th scope="col" class="text-center">Wine</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="align-middle custom-td">
                    <td class="">{{ $product->product_name }}</td>
                        {{-- <td class="">{{ $product->description }}</td> --}}
                        <td class="text-center">{{ $product->price }}</td>
                        <td class="text-center">{{ $product->age }}</td>
                        <td class="text-center">{{ $product->country }}</td>
                        {{-- <td class="text-center">{{ $product->origin }}</td> --}}
                        {{-- <td class="text-center">{{ $product->grape_type }}</td> --}}
                        <td class="text-center">{{ $product->wine_type }}</td>
                        <td><a href="#removeFromWishlist{{ $product->id }}" class="btn btn-danger mx-1"
                                data-bs-toggle="modal" data-bs-target="#removeFromWishlist{{ $product->id }}">
                                <i class="fa-solid fa-heart-circle-minus"></i>
                            </a></td>
                    </tr>
                    <!-- Modal for removing from wishlist -->
                    <div class="modal fade" id="removeFromWishlist{{ $product->id }}" tabindex="-1"
                        aria-labelledby="removeFromWishlistModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="removeFromWishlistModalLabel">Remove from
                                        Wishlist</h5>
                                    <button type="button" class="btn-close bg-danger rounded-5"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        <span class="badge bg-warning text-dark rounded-pill fs-6">{{ $product->origin }}</span>
                                        <span class="badge bg-info text-white rounded-pill fs-6">{{ $product->grape_type }}</span>
                                    </div>
                                    {{ $product->description }}
                                </div>
                                <div class="modal-footer justify-content-center bg-dark">
                                    <form
                                        action="{{ route('wishlist.remove', ['productId' => $product->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="px-4 btn btn-danger">Remove from
                                            Wishlist</button>
                                    </form>
                                    <button type="button" class="px-4 btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>



    {{-- FOOTER --}}
    <footer>
    </footer>
@endsection
