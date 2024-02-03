@extends('layouts.template')

@section('general')

<div class="container mt-5">
    <h1>Tabla Productos</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Age</th>
                <th scope="col">Origin</th>
                <th scope="col">Country</th>
                <th scope="col">Action </th>
            </tr>
        </thead>
        <tbody>
           @foreach ($products as $product)
           <tr>
                <td>{{$product->product_name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->age}}</td>
                <td>{{$product->origin}}</td>
                <td>{{$product->country}}</td>
                <td> <div class="d-flex justify-content-center">
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

                </div></td>
            </tr>


 {{-- Modal para eliminar un producto --}}
 <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="m-0 fw-medium">Are you sure you want to delete <span
                        class="fw-bolder">{{ $product->product_name }}</span> ?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <form action="{{ route('delete.producto', $product->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                </form>
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Back</button>

            </div>
        </div>
    </div>
</div>


{{-- Modal para editar un producto --}}
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.producto', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Utilizamos PUT para la actualización --}}

                    <div class="form-group">
                        <label for="product_name">Name:</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>

                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" name="age" class="form-control" value="{{ $product->age }}" required>
                    </div>

                    <div class="form-group">
                        <label for="origin">Origin:</label>
                        <input type="text" name="origin" class="form-control" value="{{ $product->origin }}" required>
                    </div>

                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" name="country" class="form-control" value="{{ $product->country }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>



        @endforeach

            <!-- Puedes agregar más filas según sea necesario -->
        </tbody>
    </table>
</div>

<div class="container">
    <div class="row justify-content-center text-center">
        <div class="d-inline-block"> <!-- Contenedor adicional para limitar el tamaño -->
            <a href="#" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<!-- Enlace para abrir el modal -->

{{-- Modal para agregar un producto --}}
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('guardar.producto') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Name:</label>
                        <input type="name" name="product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="origin">Origin:</label>
                        <input type="text" name="origin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
