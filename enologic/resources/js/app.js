import './bootstrap';

import * as bootstrap from 'bootstrap';


function addToCart(productId) {
    let quantity = document.getElementById('quantitySelect' + productId).value;

    // Redirecciona a la ruta de Laravel con los parámetros necesarios
    window.location.href = '/addToCart?productId=' + productId + '&quantity=' + quantity;

    // Cierra el modal
    $('#addProductModal' + productId).modal('hide');
}