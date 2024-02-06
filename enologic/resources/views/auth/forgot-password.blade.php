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
                <div class="card-header bg-warning fw-medium border-dark">{{ __('Reset password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <div class="form-group row mb-3 justify-content-center d-flex">
                            <label for="email" class="col-md-2 col-form-label ">{{ __('E-Mail') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Send Email') }}
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