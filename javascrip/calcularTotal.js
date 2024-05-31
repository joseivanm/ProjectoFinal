// Variable global para almacenar el total del carrito
var totalCarrito = 0;

// Función para formatear números con comas como separadores de miles y dos decimales
function formatearNumero(numero) {
    return numero.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Función para calcular el subtotal y total del carrito
function calcularTotal(productoTotal, productoPrecio,$accion) {
    var subtotalElement = document.querySelector(".subtotal");
    var totalElement = document.querySelector(".total");

    // Sumar productoTotal al total del carrito
    switch ($accion) {
        case "sumar":
            if(totalCarrito == 0) {
                totalCarrito = parseFloat(productoTotal);
                var subtotal = totalCarrito + parseFloat(productoPrecio);
            } else {
                totalCarrito += parseFloat(productoPrecio);
                var subtotal = totalCarrito ;
            }
            location.reload();
            break;

            case "restar":
            if(totalCarrito == 0) {
                totalCarrito = parseFloat(productoTotal);
                var subtotal = totalCarrito - parseFloat(productoPrecio);
                location.reload();
            } else {
                totalCarrito -= parseFloat(productoPrecio);
                var subtotal = totalCarrito ;
            }
            break;
    }

    // Calcular el subtotal sumando totalCarrito y productoPrecio


    // Calcular el total sumando el subtotal y el costo del envío
    var envio = 20.00; // Costo del envío
    var total = subtotal + envio;
    // Formatear los números con comas como separadores de miles y dos decimales
    var subtotalFormateado = formatearNumero(subtotal) + "€";
    var totalFormateado = formatearNumero(total) + "€";

    // Actualizar los elementos HTML con los nuevos valores formateados
    subtotalElement.textContent = subtotalFormateado;
    totalElement.textContent = totalFormateado;
}




// Event listener para ejecutar la función actualizarNumeroCarrito() cuando la página se carga completamente
window.addEventListener('load', function() {
    actualizarNumeroCarrito();
});

