@extends('layouts.general')

@section('wishlist')

<div class="container mt-5">
    <div class="container d-flex">

        <h1 class="col-9">COUPONS - USER</h1>

        <div class="col-3 d-flex align-items-center justify-content-end">
            {{-- Boton para volver a PROFILE --}}
            <a class="btn btn-dark" href="{{ url('/show') }}">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Coupon Code</th>
                    <th scope="col">Uses</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Actions</th>

                    <!-- Agrega más encabezados si es necesario -->
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->name }}</td>
                    <td>{{ $coupon->uses }}</td>
                    <td>{{ $coupon->percentage }}%</td>
                    <td>
                        <a href="#deleteModal{{ $coupon->id }}" id="img-style-size" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $coupon->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                {{-- Modal para eliminar un cupon --}}
                <div class="modal fade" id="deleteModal{{ $coupon->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Coupon</h5>
                                <button type="button" class="btn-close bg-danger rounded-5" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body mt-2 text-center">
                                <p class="m-0 fw-medium">Do you want to delete this coupon from database?
                                </p>
                                <p class="fw-bolder mt-3">{{ $coupon->name}}</p>
                            </div>
                            <div class="modal-footer justify-content-center bg-dark">
                                <form action="{{ route('coupon.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">
                                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>

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