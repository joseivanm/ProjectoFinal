document.addEventListener("DOMContentLoaded", function () {

    var addToCartButtons = document.querySelectorAll(".btn-up-to-cart");



    addToCartButtons.forEach(function (button) {

        button.addEventListener("click", function () {

            

            var productId = button.dataset.productId;

            var data = "action=agregar&producto=" + encodeURIComponent(productId);



            // Llamada AJAX para agregar el producto al carrito

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "/controller/agregarCarritoController.php", true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



            // Configurar el manejador de eventos onload para manejar la respuesta del servidor

            xhr.onload = function () {

                if (xhr.status === 200) {

                    

                    var productId = button.dataset.productId;

                    var cantidadElement = document.querySelector(".cantidad-" + productId);

                    var currentQuantity = parseInt(cantidadElement.textContent.trim()); // Obtener la cantidad actual del producto

                    // Sumar uno a la cantidad actual

                    var nuevaCantidad = currentQuantity + 1;

                    var productTotal = button.dataset.productTotal;

                    var productPrecio = button.dataset.productPrecio;

                    var $accion = "sumar";

                    

                    calcularTotal(productTotal, productPrecio,$accion);





                    // Actualizar la cantidad mostrada en la página para el producto correspondiente

                    if (!isNaN(nuevaCantidad)) {

                        cantidadElement.textContent = nuevaCantidad;

                        actualizarNumeroCarrito();

                        GamepadHapticActuator

                     } else {

                        alert("Error al sumar la cantidad para el producto con ID: " + productId);

                    }

                     

                } else {

                    alert("Error al procesar la solicitud. Estado de la respuesta: " + xhr.status);

                }

            };



            // Configurar el manejador de eventos onerror para manejar errores de red

            xhr.onerror = function (error) {

                alert("Error de red al agregar el producto al carrito: " + xhr.status);

            };



            // Enviar la solicitud

            xhr.send(data);

        });

        /*function actualizarContadorCarrito(cantidad) {

            var cartBadge = document.getElementById("cart-badge");

            cartBadge.textContent = cantidad;

    

            // Muestra el contenedor del carrito si hay elementos en él

            var cartContainer = document.getElementById("cart-container");

            cartContainer.classList.toggle("d-none", cantidad === 0);

        }*/

    });





});

