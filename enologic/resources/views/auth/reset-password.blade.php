@extends('auth.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-center">
                    <div id="success-alert"
                        class="fw-medium col-10 col-md-6 alert-info text-center alert alert-success d-none" role="alert">
                        Password updated successfully.
                    </div>
                </div>

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

                            {{-- PASSWORD ERROR --}}
                            <div id="password-error" class="text-danger"></div>

                            {{-- SUBMIT --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button id="reset-password-btn" type="submit" class="btn btn-dark" value="Update">
                                        {{ __('Reset password') }}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el envío exitoso del formulario
        document.getElementById('reset-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario
            var form = this;

            // Validar que las contraseñas coincidan
            var password = form.querySelector('#password').value;
            var confirmPassword = form.querySelector('#password-confirm').value;
            if (password !== confirmPassword) {
                // Mostrar un mensaje de error
                console.error('Las contraseñas no coinciden.');
                return; // No enviar el formulario si las contraseñas no coinciden
            }

            // Validar la expresión regular
            let passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(password)) {
                // Mostrar un mensaje de error si la contraseña no cumple con la expresión regular
                console.error(
                    'La contraseña debe tener al menos 8 caracteres, incluyendo al menos una letra mayúscula, un número y un carácter especial.'
                    );
                return; // No enviar el formulario si la contraseña no cumple con la expresión regular
            }

            // Limpiar cualquier mensaje de error previo
            document.getElementById('password-error').innerText = '';

            // Envía el formulario mediante AJAX solo si las contraseñas coinciden y la contraseña cumple con la expresión regular
            var formData = new FormData(form);
            fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Muestra el alert de éxito
                        document.getElementById('success-alert').classList.remove('d-none');
                        form.reset(); // Limpia el formulario
                    } else {
                        // Manejar errores en caso de que ocurran
                        // Puedes mostrar un mensaje de error o hacer algo más aquí
                        console.error('Error al enviar el formulario');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>
