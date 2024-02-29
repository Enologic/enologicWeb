@extends('layouts.general')

@section('coupons')

<div class="container mt-5">
    <div class="container d-flex">

        <h1 class="col-9">Coupons - USER</h1>

        <div class="col-3 d-flex align-items-center justify-content-end">
            {{-- Boton para volver a PROFILE --}}
            <a class="btn btn-dark" href="{{ url('/add') }}">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
        </div>
    </div>

   
</div>

@endsection