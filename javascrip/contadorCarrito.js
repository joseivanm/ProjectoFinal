// Función para actualizar el número de productos en el carrito

function actualizarNumeroCarrito() {

    // Realizar una solicitud AJAX al servidor para obtener la cantidad de productos en el carrito

    fetch('/controller/obtenerNumeroProductosCarrito.php')

    .then(response => response.text())

    .then(data => {

            // Actualizar el número en el badge del carrito

            document.getElementById('cart-badge1').textContent = data;

            document.getElementById('cart-badge').textContent = data;

            

        })

        .catch(error => console.error('Error al obtener la cantidad de productos en el carrito:', error));

}







// Llamar a la función para actualizar el número de productos en el carrito cuando la página se cargue

window.addEventListener('load', function() {

    actualizarNumeroCarrito();

});



document.addEventListener('click', function(event) {

    if (event.target.classList.contains('btn-add-to-cart')) {

        const productId = event.target.dataset.productId;

        // Realizar una solicitud AJAX al servidor para agregar el producto al carrito (aquí debes agregar tu lógica)

        // Después de agregar el producto, llamar a la función para actualizar el número de productos en el carrito

        actualizarNumeroCarrito();

    }

});

