@extends('auth.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('alert'))
                    <div class="container d-flex justify-content-center">
                        <div id="success-alert"
                            class="col-6 alert alert-info fw-medium alert-{{ session('alert.type') }} alert-dismissible fade show text-center"
                            role="alert">
                            <strong>{{ session('alert.message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="card mt-2 border-dark">
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
