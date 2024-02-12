@extends('layouts.template')

@section('general')
{{-- HEADER --}}
<nav>
</nav>

{{-- Vista principal --}}
{{-- Aquí irán todos los yields de las vistas que tengamos. --}}
<div class="container mt-5">
    <h1 class="mb-4">Wishlist - USER</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Age</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Country</th>
                    <th scope="col">Grape Type</th>
                    <th scope="col">Wine Type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}€</td>
                    <td>{{ $product->age }} years</td>
                    <td>{{ $product->origin }}</td>
                    <td>{{ $product->country }}</td>
                    <td>{{ $product->grape_type }}</td>
                    <td>{{ $product->wine_type }}</td>
                    <td><a href="#removeFromWishlist{{ $product->id }}" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#removeFromWishlist{{ $product->id }}">
                            <i class="fa-solid fa-heart-circle-minus"></i>
                        </a></td>
                </tr>
                <!-- Modal for removing from wishlist -->
                <div class="modal fade" id="removeFromWishlist{{ $product->id }}" tabindex="-1" aria-labelledby="removeFromWishlistModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="removeFromWishlistModalLabel">Remove from Wishlist</h5>
                                <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex align-items-center justify-content-center">
                                <div class="col-12 fw-medium text-center">
                                    <h5>Are you sure you want to remove this product from your wishlist?</h5>
                                    <p>Product Name: {{ $product->product_name }}</p>
                                </div>
                            </div>
                            <div class="container pb-3 px-3 text-center">
                                {{ $product->description }}
                            </div>
                            <div class="modal-footer justify-content-center bg-dark">
                                <form action="{{ route('wishlist.remove', ['productId' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="px-4 btn btn-danger">Remove from Wishlist</button>
                                </form>
                                <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



{{-- FOOTER --}}
<footer>
</footer>
@endsection