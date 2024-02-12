@extends('auth.template')

    {{-- Rutas css/js --}}
    @vite(['resources/js/validation-auth.js'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-dark">
                    <div class="card-header bg-warning fw-medium border-dark">{{ __('Reset password') }}</div>

                    <div class="card-body">
                        <form method="POST" id="reset-form" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            {{-- PASSWORD --}}
                            <div class="form-group row mb-3">
                                <label for="password"
                                    class="col-md-5 col-lg-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- PASSWORD CONFIRM --}}
                            <div class="form-group row mb-3">
                                <label for="password-confirm"
                                    class="col-md-5 col-lg-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- SUBMIT --}}
                            <div class="form-group row mb-0">
                                <div class="text-center">
                                    <a type="submit" href="{{ route('login') }}" class="btn btn-dark" value="Update">
                                        {{ __('Reset password') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
