@extends('auth.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card mt-5 border-dark">
                    <div class="card-header bg-warning fw-medium border-dark">
                        Vistas
                    </div>

                    <div class="card-body d-flex justify-content-center">

                        <div class="col-6 text-center">
                            {{-- USER --}}
                            <a class="btn btn-dark mb-3" href="{{ route('show') }}">
                                {{ __('Blade show') }}
                            </a>
                            <p>Vista para el user</p>
                        </div>

                        <div class="col-6 text-center">
                            {{-- ADMIN --}}
                            <a class="btn btn-dark mb-3" href="{{ route('add') }}">
                                {{ __('Blade add') }}
                            </a>
                            <p>Vista para el admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
