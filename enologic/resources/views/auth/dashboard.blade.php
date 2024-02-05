@extends('auth.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                    </div>
                </div>
                <div class="card mt-5 border-dark">
                    <div class="card-header bg-warning fw-medium border-dark">
                        Vistas
                    </div>

                    <div class="card-body d-flex justify-content-center">

                        <div class="col-6 text-center">
                            {{-- USER --}}
                            <a class="btn btn-info border-dark mb-3" href="{{ route('show') }}">
                                {{ __('Blade show') }}
                            </a>
                            <p>Vista para el user</p>
                        </div>

                        <div class="col-6 text-center">
                            {{-- ADMIN --}}
                            <a class="btn btn-info border-dark mb-3" href="{{ route('add') }}">
                                {{ __('Blade add') }}
                            </a>
                            <p>Vista para el user</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
