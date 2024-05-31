document.addEventListener("DOMContentLoaded", function () {





    var addToCartButtons = document.querySelectorAll(".btn-add-to-cart");



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



                    location.reload();

                } else {

                    alert("Error al agregar el producto al carrito1. Estado de la respuesta:" + xhr.status);

                }

            };



            // Configurar el manejador de eventos onerror para manejar errores de red

            xhr.onerror = function (error) {

                alert("AError de red al agregar el producto al carrito5: "+ xhr.status);

            };



            

            // Enviar la solicitud

            xhr.send(data);



        });

    });

        /*function actualizarContadorCarrito(cantidad) {

        var cartBadge = document.getElementById("cart-badge");

        cartBadge.textContent = cantidad;



        // Muestra el contenedor del carrito si hay elementos en él

        var cartContainer = document.getElementById("cart-container");

        cartContainer.classList.toggle("d-none", cantidad === 0);

    }*/

});