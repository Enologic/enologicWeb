'use strict';

function validateEditProductForm(productId) {
    let form = document.getElementById('editForm' + productId);
    let productName = form.elements['product_name'].value;
    let description = form.elements['description'].value;
    let price = form.elements['price'].value;
    let age = form.elements['age'].value;
    let origin = form.elements['origin'].value;
    let country = form.elements['country'].value;
    let grapeType = form.elements['grape_type'].value;
    let wineType = form.elements['wine_type'].value;
    let stock = form.elements['stock'].value;

    // Otras validaciones
    let isValid = true; // Variable para seguir el estado de la validación

    if (!validateNameDescription(productName)) {
        console.log('El nombre del producto solo debe contener números y letras.');
        isValid = false; // Marcar como inválido
    }

    if (!validateNameDescription(description)) {
        console.log('La descripción solo debe contener números y letras.');
        isValid = false; // Marcar como inválido
    }

    if (!validatePositiveNumber(price)) {
        console.log('El precio debe ser un número positivo.');
        isValid = false; // Marcar como inválido
    }

    if (!validatePositiveNumber(age)) {
        console.log('La edad debe ser un número positivo.');
        isValid = false; // Marcar como inválido
    }

    if (!validatePositiveNumber(stock)) {
        console.log('El stock debe ser un número positivo.');
        isValid = false; // Marcar como inválido
    }

    if (!validateLetters(origin)) {
        console.log('El país de origen solo debe contener letras.');
        isValid = false; // Marcar como inválido
    }

    if (!validateLetters(country)) {
        console.log('El país solo debe contener letras.');
        isValid = false; // Marcar como inválido
    }

    // Deshabilitar el botón de enviar si los datos no son válidos
    let submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = !isValid;

    return isValid; // Devolver el estado de la validación
}
