@extends('layouts.template')

@section('general')
<div class="container">
    <h2>Add Product</h2>
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
@endsection
