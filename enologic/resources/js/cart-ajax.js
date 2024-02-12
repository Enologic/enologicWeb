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

            // Actualizar el subtotal
            let price = parseFloat(
                $(this).closest("tr").find(".price").text().replace(" €", "")
            );
            $(this)
                .closest("tr")
                .find(".subtotal")
                .text(price * newQuantity + " €");
            let total = 0;
            $(".subtotal").each(function () {
                let subtotal = parseFloat($(this).text().replace(" €", ""));
                total += subtotal;
            });
            $("h5#total").text("Total" + ": " + total + " €");
        }
    });

    // Manejar el click en el botón de aumento
    $(".increase").click(function () {
        let productId = $(this).data("product-id");

        // Realizar la solicitud AJAX para aumentar la cantidad
        $.post(increaseUrl.replace("?", productId), function (data) {
            console.log("La ruta POST de aumento fue llamada correctamente");
        });

        let quantityInput = $(this).siblings(".quantity");
        let currentQuantity = parseInt(quantityInput.val());

        // Incrementar la cantidad
        let newQuantity = currentQuantity + 1;
        quantityInput.val(newQuantity);

        // Actualizar el subtotal
        let price = parseFloat(
            $(this).closest("tr").find(".price").text().replace(" €", "")
        );
        $(this)
            .closest("tr")
            .find(".subtotal")
            .text(price * newQuantity + " €");
        let total = 0;
        $(".subtotal").each(function () {
            let subtotal = parseFloat($(this).text().replace(" €", ""));
            total += subtotal;
        });
        $("h5#total").text("Total" + ": " + total + " €");
    });
});