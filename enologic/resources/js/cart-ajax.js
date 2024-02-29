$(document).ready(function () {
    // Configurar el token CSRF para todas las solicitudes AJAX
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Manejar el click en el botón de disminución
    $(".decrease").click(function () {
        let productId = $(this).data("product-id");
        let unitDeleteSpan = $('#units-delete');
        let subtotalModal = $(`#subtotalModal${productId}`); 
        let quantityModal = $(`#quantityModal${productId}`); 


        // Realizar la solicitud AJAX para disminuir la cantidad
        $.post(decreaseUrl.replace("?", productId), function (data) {
            console.log("La ruta POST de reducción fue llamada correctamente");
        });

        let quantityInput = $(this).siblings(".quantity");
        let currentQuantity = parseInt(quantityInput.val());

        if (currentQuantity > 1) {
            // Decrementar la cantidad
            let newQuantity = currentQuantity - 1;
            quantityInput.val(newQuantity);
            unitDeleteSpan.text("x"+newQuantity);

            // Actualizar el subtotal
            let price = parseFloat(
                $(this).closest("tr").find(".price").text().replace(" €", "")
            );
            $(this)
                .closest("tr")
                .find(".subtotal")
                .text(price * newQuantity + " €");
                subtotalModal.text(price * newQuantity + " €");;
            let total = 0;
            $(".subtotal").each(function () {
                let subtotal = parseFloat($(this).text().replace(" €", ""));
                total += subtotal;
            });
            $("h5#total").text("Total" + ": " + total + " €");
            quantityModal.text(newQuantity);
            updateTotal()
        }
    });

    // Manejar el click en el botón de aumento
    $(".increase").click(function () {
        let productId = $(this).data("product-id");
        let unitDeleteSpan = $('#units-delete');

        // Realizar la solicitud AJAX para obtener el stock del producto
        $.get(stockUrl.replace(':id', productId), function (stock) {
            let quantityInput = $(this).siblings(".quantity");
            let currentQuantity = parseInt(quantityInput.val());

            // Verificar si la cantidad actual es menor que el stock disponible
            if (currentQuantity < stock) {
                // Realizar la solicitud AJAX para aumentar la cantidad
                $.post(increaseUrl.replace("?", productId), function (data) {
                    console.log("La ruta POST de aumento fue llamada correctamente");
                });

                // Incrementar la cantidad
                let newQuantity = currentQuantity + 1;
                quantityInput.val(newQuantity);
                unitDeleteSpan.text("x"+newQuantity);
                let quantityModal = $(`#quantityModal${productId}`); 
                quantityModal.text(newQuantity);
                let subtotalModal = $(`#subtotalModal${productId}`); 

                // Actualizar el subtotal
                let price = parseFloat($(this).closest("tr").find(".price").text().replace(" €", ""));
                $(this)
                    .closest("tr")
                    .find(".subtotal")
                    .text(price * newQuantity + " €");
                let total = 0;
                $(".subtotal").each(function () {
                    let subtotal = parseFloat($(this).text().replace(" €", ""));
                    subtotalModal.text(price * newQuantity + " €");;

                    total += subtotal;
                });
                $("h5#total").text("Total" + ": " + total + " €");
                
                updateTotal()
            } else {
            }
        }.bind(this)); // Bind 'this' para mantener la referencia adecuada dentro de la función de devolución de llamada
    });

    // Función para actualizar el total
    function updateTotal() {
        let total = 0;
        $(".subtotal").each(function () {
            let subtotal = parseFloat($(this).text().replace(" €", ""));
            total += subtotal;
        });
        $("h5#total").text("Total" + ": " + total.toFixed(2) + " €");
    }
});
