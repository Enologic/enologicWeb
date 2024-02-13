'use strict'

/* Login y registro */


document.addEventListener('DOMContentLoaded', function () {

    // Las 4 regex que necesitamos para el formato correcto
    function validarName(name) {
        let nameRegex = /^[a-zA-Z0-9\s]{3,20}$/;
        return nameRegex.test(name);
    }

    function validarUsername(username) {
        let usernameRegex = /^[a-zA-Z0-9]{5,20}$/;
        return usernameRegex.test(username);
    }

    function validarEmail(email) {
        let emailRegex = /^[a-zA-Z0-9._-]+@enologic\.com$/;
        return emailRegex.test(email);
    }

    function validarPhone(phone) {
        let phoneRegex = /^\d{9,15}$/;
        return phoneRegex.test(phone);
    }

    function validarPassword(password) {
        let passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        return passwordRegex.test(password);
    }

    function validarFormulario(event, validations) {
        for (let validation of validations) {
            let input = document.getElementById(validation.inputId);
            if (!validation.validator(input.value)) {
                console.error(validation.errorMessage);
                event.preventDefault();
                return;
            }
        }
    }

    // Función que borra el alert de registro cuando se pulsa en resend email
    document.addEventListener('DOMContentLoaded', function () {
        let resendButton = document.getElementById('resend-button');
        let successAlert = document.getElementById('success-alert');

            resendButton.addEventListener('click', function() {
                // Oculta el alert de éxito
                successAlert.classList.add('d-none');
            });
    });

    // Solo validará el fragmento que tenga el id del formulario de la vista
    // Fragmento que valida registro
    let registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (event) {
            validarFormulario(event, [
                { inputId: 'name', validator: validarName, errorMessage: 'El nombre solo puede contener letras y espacios. Entre 3 y 20 caracteres.' },
                { inputId: 'username', validator: validarUsername, errorMessage: 'El username solo puede contener letras y números. Entre 5 y 20 caracteres.' },
                { inputId: 'email', validator: validarEmail, errorMessage: 'El email debe tener este formato "xxx@enologic.com".' },
                { inputId: 'phone', validator: validarPhone, errorMessage: 'El phone solo puede contener números. Entre 9 y 15 dígitos' },
                { inputId: 'password', validator: validarPassword, errorMessage: 'La contraseña debe tener al menos 8 caracteres, 1 mayúscula, 1 número y 1 carácter especial.' },
                { inputId: 'password-confirm', validator: (value) => value === document.getElementById('password').value, errorMessage: 'La confirmación de la contraseña no coincide.' }
            ], 'register-form');
        });
    }

    // Fragmento que valida login
    let loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (event) {
            validarFormulario(event, [
                { inputId: 'email', validator: validarEmail, errorMessage: 'El email debe tener este formato "xxx@enologic.com".' },
            ], 'login-form');
        });
    }

    // Fragmento que valida forgot-password
    let forgotForm = document.getElementById('forgot-form');
    if (forgotForm) {
        forgotForm.addEventListener('submit', function (event) {
            validarFormulario(event, [
                { inputId: 'email', validator: validarEmail, errorMessage: 'El email debe tener este formato "xxx@enologic.com".' },
            ], 'forgot-form');
        });
    }
});