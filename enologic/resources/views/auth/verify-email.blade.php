
@extends('auth.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
        @endif
        <div class="col-md-8">
            <div class="card border-dark">
                <div class="card-header bg-warning border-dark fw-medium">{{ __('Email Verification') }}</div>

                <div class="card-body">
                    <p class="fst-italic text-center">You must verify your email address. Please, check your email for a verification link</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark" value="Resend">
                                    {{ __('Resend Email') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection