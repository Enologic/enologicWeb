@extends('layouts.general')

@section('add')
    <div class="container mt-3">

        <h1 class="text-center pb-1"><span class="rounded-pill title-custom px-3">Add products</span></h1>
        <div class="container d-flex align-items-center justify-content-between">

            <!-- Agregar el campo de filtrado por categorías -->
            <div class="col-5 mb-3">
                <label for="category" class="fw-medium filter-custom">Filter by Category</label>
                <select id="category" class="form-select" onchange="filterByCategory()">
                    <option value="">{{ isset($category) ? $category : 'All Categories' }}</option>
                    {{-- Aquí puedes iterar sobre las categorías disponibles y mostrarlas como opciones --}}
                    @foreach ($grapeTypes as $grapeType)
                        <option value="{{ $grapeType }}">{{ $grapeType }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 text-end">
                {{-- Botón para volver a DASHBOARD --}}
                <a class="btn btn-dark" href="{{ url('/home') }}">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                {{-- Botón PROFILE --}}
                <a class="btn btn-dark custom-alert" href="{{ url('/profile') }}">
                    <i class="fa-solid fa-user"></i>
                </a>
                {{-- Botón para añadir un producto --}}
                <a href="#" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fa-solid fa-plus"></i>
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
                    {{-- <th scope="col" class="text-center">Country</th> --}}
                    {{-- <th scope="col" class="text-center">Origin</th> --}}
                    {{-- <th scope="col" class="text-center">Grape</th> --}}
                    <th scope="col" class="text-center">Wine</th>
                    <th scope="col" class="text-center">Stock</th>
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
                        {{-- <td class="text-center">{{ $product->country }}</td> --}}
                        {{-- <td class="text-center">{{ $product->origin }}</td> --}}
                        {{-- <td class="text-center">{{ $product->grape_type }}</td> --}}
                        <td class="text-center">{{ $product->wine_type }}</td>
                        <td class="text-center">{{ $product->stock }}</td>
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
                                            <label for="age" class="fw-medium">Age:</label>
                                            <input type="number" name="age" class="form-control"
                                                value="{{ $product->age }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="origin" class="fw-medium">Origin:</label>
                                            <input type="text" name="origin" class="form-control"
                                                value="{{ $product->origin }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="country" class="fw-medium">Country:</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{ $product->country }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="grape_type" class="fw-medium">Grape Type:</label>
                                            <select name="grape_type" class="form-control" required>
                                                @foreach ($grapeTypes as $grapeType)
                                                    <option value="{{ $grapeType }}">{{ $grapeType }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="wine_type" class="fw-medium">Wine Type:</label>
                                            <select name="wine_type" class="form-control" required>
                                                @foreach ($wineTypes as $wineType)
                                                    <option value="{{ $wineType }}">{{ $wineType }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="stock" class="fw-medium">Stock:</label>
                                            <input type="number" name="stock" class="form-control"
                                                value="{{ $product->stock }}" required>
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
        <div class="container pagination-custom pb-2">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>


    <!-- Enlace para abrir el modal -->

    {{-- Modal para agregar un producto --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guardar.producto') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="product_name" class="fw-medium">Name:</label>
                            <input type="name" name="product_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="fw-medium">Description:</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="fw-medium">Price:</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="age" class="fw-medium">Age:</label>
                            <input type="number" name="age" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="origin" class="fw-medium">Origin:</label>
                            <input type="text" name="origin" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="country" class="fw-medium">Country:</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="grape_type" class="fw-medium">Grape Type:</label>
                            <select name="grape_type" class="form-control" required>
                                @foreach ($grapeTypes as $grapeType)
                                    <option value="{{ $grapeType }}">{{ $grapeType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="wine_type" class="fw-medium">Wine Type:</label>
                            <select name="wine_type" class="form-control" required>
                                @foreach ($wineTypes as $wineType)
                                    <option value="{{ $wineType }}">{{ $wineType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="stock" class="fw-medium">Stock:</label>
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


    <div class="container mb-3">
        <h3 class="text-center pb-1"><span class="rounded-pill title-custom px-3">Top 3 products</span></h3>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="custom-th">
                        <th scope="col">Name</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Times Added</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mostAddedProducts as $product)
                        <tr class="custom-td">
                            @php
                                // Buscar el producto correspondiente en los detalles de los productos más añadidos
                                $productDetails = $mostAddedProductsDetails->where('id', $product->product_id)->first();
                            @endphp
                            <td>{{ $productDetails->product_name }}</td>
                            <td class="text-center">{{ $productDetails->price }}</td>
                            <td class="text-center">{{ $product->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
