@extends('auth.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            @if (session('showAlert'))
                <div class="container d-flex justify-content-center">
                    <div id="success-alert" class="col-6 col-md-7 alert alert-info alert-dismissible fade show text-center"
                        role="alert">
                        <strong>You are logged in</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                {{ session()->forget('showAlert') }}
            @endif

            <div class="col-md-8">
                <div class="card border-dark">
                    <div class="card-header bg-warning border-dark fw-medium">{{ __('Email Verification') }}</div>

                    <div class="card-body">
                        <p class="fst-italic text-center">You must verify your email address. Please, check your email for a
                            verification link</p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="form-group row mb-0">
                                <div class="text-center">
                                    <button id="resend-button" type="submit" class="btn btn-dark" value="Resend">
                                        {{ __('Resend Email') }}
                                    </button>

                                </div>
                            </div>

                            @if (session('status'))
                                <div class="container d-flex justify-content-center">
                                    <div class="col-8 mt-4 alert alert-info alert-dismissible fade show text-center"
                                        role="alert">
                                        <strong>Email resent. Check your SPAM folder</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
