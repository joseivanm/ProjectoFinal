document.addEventListener("DOMContentLoaded", function () {

    var addToCartButtons = document.querySelectorAll(".btn-add-to-cart");



    addToCartButtons.forEach(function (button) {

        button.addEventListener("click", function () {

            var productId = button.dataset.productId;

            var data = "action=agregar&producto=" + encodeURIComponent(productId);



            // Llamada AJAX para verificar el stock antes de agregar el producto al carrito

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "/controller/verificarStockController.php", true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



            xhr.onload = function () {

                if (xhr.status === 200) {

                    // Verificar si hay suficiente stock

                    var response = JSON.parse(xhr.responseText);

                    if (response.success) {

                        // Si hay suficiente stock, agregar el producto al carrito

                        var xhrAgregar = new XMLHttpRequest();

                        xhrAgregar.open("POST", "/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/controller/agregarCarritoController.php", true);

                        xhrAgregar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                        xhrAgregar.onload = function () {

                            if (xhrAgregar.status === 200) {

                                // Manejar la respuesta si es necesaria

                                alert("Producto agregado al carrito exitosamente.");

                            } else {

                                alert("Error al agregar el producto al carrito. Estado de la respuesta:" + xhrAgregar.status);

                            }

                        };

                        xhrAgregar.onerror = function () {

                            alert("Error de red al agregar el producto al carrito.");

                        };

                        xhrAgregar.send(data);

                    } else {

                        alert(response.message);

                    }

                } else {

                    alert("Error al verificar el stock. Estado de la respuesta:" + xhr.status);

                }

            };



            xhr.onerror = function () {

                alert("Error de red al verificar el stock.");

            };



            xhr.send(data);

        });

    });

});

