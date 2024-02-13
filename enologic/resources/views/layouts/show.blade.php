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
             <!-- Agregar el campo de filtrado por categorías -->
    <div class="mb-3">
        <label for="category" class="fw-medium">Filter by Category:</label>
        <select id="category" class="form-select"  onchange="filterByCategory()">
            <option value="">{{ $category }}</option>
            {{-- Aquí puedes iterar sobre las categorías disponibles y mostrarlas como opciones --}}
            @foreach ($grapeTypes as $grapeType)
            <option value="{{ $grapeType }}">{{ $grapeType }}</option>
        @endforeach
        </select>
    </div>
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
                <th scope="col">Grape Type</th>
                <th scope="col">Wine Type</th>
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
                <td>{{ $product->grape_type }}</td>
                <td>{{ $product->wine_type }}</td>

                <td class="">
                    <div class="d-flex justify-content-center">

                        {{-- Botón para añadir un producto --}}
                        <a href="#addProductModal{{ $product->id }}" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#addProductModal{{ $product->id }}">
                            <i class="fa-regular fa-plus"></i>
                        </a>
                        @if ($product->wishlists()->where('user_id', Auth::id())->exists())
                        <a href="#removeFromWishlist{{ $product->id }}" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#removeFromWishlist{{ $product->id }}">
                            <i class="fa-solid fa-heart-circle-minus"></i>
                        </a>
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
                        @else
                        {{-- Botón para añadir a la lista de deseos --}}
                        <a href="#addToWishlist{{ $product->id }}" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#addToWishlist{{ $product->id }}">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                        {{-- Modal for adding to wishlist --}}
                        <div class="modal fade" id="addToWishlist{{ $product->id }}" tabindex="-1" aria-labelledby="addToWishlistModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="addToWishlistModalLabel">Add to Wishlist</h5>
                                        <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex align-items-center justify-content-center">
                                        <!-- You can show more product details here if you want -->
                                        <div class="col-12 fw-medium text-center">
                                            <h5>Are you sure you want to add this product to your wishlist?</h5>

                                            Product Name: {{ $product->product_name }}
                                        </div>
                                        <!-- You can add more product details here -->
                                    </div>
                                    <div class="container pb-3 px-3 text-center">
                                        {{ $product->description }}
                                    </div>
                                    <div class="modal-footer justify-content-center bg-dark">
                                        <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="px-4 btn btn-success">Add to Wishlist</button>
                                        </form>
                                        <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endif
                        {{-- Modal para añadir un producto --}}
                        <div class="modal fade" id="addProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="post">
                                        @csrf
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title" id="addProductModalLabel">
                                                {{ $product->product_name }}
                                            </h5>
                                            <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex align-items-center justify-content-center">
                                            <div class="col-4 m-0 fw-medium text-center">
                                                Choose quantity:
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select" id="quantitySelect{{ $product->id }}" name="quantity">
                                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}
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
                                            <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Back</button>
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

<script>
    // Función para manejar el cambio en el menú desplegable de categorías
    function filterByCategory() {
        // Obtener el valor seleccionado del menú desplegable
        var category = document.getElementById("category").value;

        // Redirigir a la página actual con el parámetro de la categoría seleccionada
        window.location.href = "{{ route('filterByCategory') }}?category=" + category;
    }
</script>

@endsection
