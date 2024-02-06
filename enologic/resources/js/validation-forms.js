'use strict'

/* Login y register */

document.addEventListener('DOMContentLoaded', function () {

    // Las 4 regex que necesitamos para el formato correcto
    function validarName(name) {
        let nameRegex = /^[a-zA-Z0-9\s]{5,20}$/;
        return nameRegex.test(name);
    }

    function validarUsername(username) {
        let usernameRegex = /^[a-zA-Z0-9]{5,20}$/;
        return usernameRegex.test(username);
    }

    function validarEmail(email) {
        let emailRegex = /^[a-zA-Z0-9._-]+@example\.com$/;
        return emailRegex.test(email);
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

    // Solo validará el fragmento que tenga el id del formulario de la vista
    // Fragmento que valida registro
    let registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (event) {
            validarFormulario(event, [
                { inputId: 'name', validator: validarName, errorMessage: 'El nombre solo puede contener letras y espacios. Máximo 20 caracteres.' },
                { inputId: 'username', validator: validarUsername, errorMessage: 'El username solo puede contener letras y números. Máximo 20 caracteres.' },
                { inputId: 'email', validator: validarEmail, errorMessage: 'El email debe tener este formato "xxx@example.com".' },
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
                { inputId: 'email', validator: validarEmail, errorMessage: 'El email debe tener este formato "xxx@example.com".' },
                { inputId: 'password', validator: (value) => value.length >= 8, errorMessage: 'La contraseña debe tener al menos 8 caracteres.' }
            ], 'login-form');
        });
    }
});