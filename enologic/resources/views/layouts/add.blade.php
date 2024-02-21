
@extends('layouts.general')

@section('add')
    <div class="container my-5">
        <div class="container d-flex">

            <h1 class="col-9">Products - ADMIN</h1>

            <div class="container d-flex justify-content-end">

                <div class="">
                    {{-- Botón para volver a DASHBOARD --}}
                    <a class="btn btn-dark mb-3" href="{{ url('/home') }}">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                    <a class="btn btn-dark mb-3" href="{{ url('/profile') }}">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
                {{-- Botón para añadir un producto --}}
                <div class="">
                    <div class="d-inline-block"> <!-- Contenedor adicional para limitar el tamaño -->
                        <a href="#" class="btn btn-success mx-1" data-bs-toggle="modal"
                            data-bs-target="#addProductModal">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    {{-- <th scope="col">Description</th> --}}
                    <th scope="col">Price</th>
                    <th scope="col">Age</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Country</th>
                    <th scope="col">Grape Type</th>
                    <th scope="col">Wine Type</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="align-middle">
                    <td>{{ $product->product_name }}</td>
                    {{-- <td>{{ $product->description }}</td> --}}
                    <td>{{ $product->price }}€</td>
                    <td>{{ $product->age }} years</td>
                    <td>{{ $product->origin }}</td>
                    <td>{{ $product->country }}</td>
                    <td>{{ $product->grape_type }}</td>
                    <td>{{ $product->wine_type }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                            <div class="d-flex justify-content-center">
                                {{-- Botón para editar un Producto --}}
                                <a href="#editModal{{ $product->id }}" id="img-style-size" class="btn btn-warning mx-1"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                {{-- Botón para eliminar un Producto --}}
                                <a href="#deleteModal{{ $product->id }}" id="img-style-size" class="btn btn-danger mx-1"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </div>
                        </td>
                    </tr>


                    {{-- Modal para eliminar un producto --}}
                    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                                    <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body mt-2 text-center">
                                    <p class="m-0 fw-medium">Do you want to delete this product from database?
                                    </p>
                                    <p class="fw-bolder mt-3">{{ $product->product_name }}</p>
                                </div>
                                <div class="modal-footer justify-content-center bg-dark">
                                    <form action="{{ route('delete.producto', $product->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Modal para editar un producto --}}
                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('update.producto', $product->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') {{-- Utilizamos PUT para la actualización --}}

                                        <div class="form-group mb-3">
                                            <label for="product_name" class="fw-medium">Name:</label>
                                            <input type="text" name="product_name" class="form-control"
                                                value="{{ $product->product_name }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description" class="fw-medium">Description:</label>
                                            <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="price" class="fw-medium">Price:</label>
                                            <input type="number" name="price" class="form-control"
                                                value="{{ $product->price }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="age"class="fw-medium">Age:</label>
                                            <input type="number" name="age" class="form-control"
                                                value="{{ $product->age }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="origin"class="fw-medium">Origin:</label>
                                            <input type="text" name="origin" class="form-control"
                                                value="{{ $product->origin }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="country"class="fw-medium">Country:</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{ $product->country }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="grape_type" class="fw-medium">Grape Type:</label>
                                            <select name="grape_type" class="form-control" required>
                                                @foreach($grapeTypes as $grapeType)
                                                    <option value="{{ $grapeType }}">{{ $grapeType }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="wine_type" class="fw-medium">Wine Type:</label>
                                            <select name="wine_type" class="form-control" required>
                                                @foreach($wineTypes as $wineType)
                                                    <option value="{{ $wineType }}">{{ $wineType }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="stock"class="fw-medium">Stock:</label>
                                            <input type="number" name="stock" class="form-control"  value="{{ $product->stock }}" required>
                                        </div>
                                </div>
                                <div class="modal-footer justify-content-center bg-dark">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Puedes agregar más filas según sea necesario -->
            </tbody>
        </table>
    </div>


    <!-- Enlace para abrir el modal -->

    {{-- Modal para agregar un producto --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guardar.producto') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="product_name"class="fw-medium">Name:</label>
                            <input type="name" name="product_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description"class="fw-medium">Description:</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price"class="fw-medium">Price:</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="age"class="fw-medium">Age:</label>
                            <input type="number" name="age" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="origin"class="fw-medium">Origin:</label>
                            <input type="text" name="origin" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="country"class="fw-medium">Country:</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="grape_type" class="fw-medium">Grape Type:</label>
                            <select name="grape_type" class="form-control" required>
                                @foreach($grapeTypes as $grapeType)
                                    <option value="{{ $grapeType }}">{{ $grapeType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="wine_type" class="fw-medium">Wine Type:</label>
                            <select name="wine_type" class="form-control" required>
                                @foreach($wineTypes as $wineType)
                                    <option value="{{ $wineType }}">{{ $wineType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="stock"class="fw-medium">Stock:</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>

                </div>
                <div class="modal-footer justify-content-center bg-dark">
                    <button type="submit" class="btn btn-success">Add Product</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mb-5">
    <h2>Top 3 Favorite Products</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Times Added to Favorites</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mostAddedProducts as $product)
                <tr>
                    @php
                        // Obtener el producto correspondiente de la base de datos
                        $productDetails = $products->where('id', $product->product_id)->first();
                    @endphp
                    <td>{{ $productDetails->product_name }}</td>
                    <td>{{ $productDetails->price }}</td>
                    <td>{{ $product->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
