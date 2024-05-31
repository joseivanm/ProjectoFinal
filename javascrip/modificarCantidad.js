document.addEventListener('click', function(event) {

    if (event.target.classList.contains('btn-add-to-cart') || event.target.classList.contains('.cantidad-') ) {

        const productId = event.target.dataset.productId;

        /*alert(productId);

        // Realizar una solicitud AJAX al servidor para sumar la cantidad disponible

        fetch('../controller/sumarcantidad.php?id=' + productId)

        .then(response => response.text())

        .then(data => {

            // Verificar si la operación fue exitosa y mostrar un mensaje

            if (data.includes('correctamente')) {

                alert('Cantidad sumada correctamente.');

            } else {

                alert('Error al sumar la cantidad disponible del producto.');

            }

        })

        .catch(error => console.error('Error al sumar la cantidad disponible:', error));*/

/////////////////////////////////////////////////////////////////////

            var data = "id=" + encodeURIComponent(productId);



            // Llamada AJAX para agregar el producto al carrito

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "/controller/sumarCantidad.php", true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



            // Configurar el manejador de eventos onload para manejar la respuesta del servidor

            xhr.onload = function () {

                if (xhr.status === 200) {

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





    }



    if (event.target.classList.contains('btn-remove')) {

        const productId = event.target.dataset.productId;

        // Realizar una solicitud AJAX al servidor para restar la cantidad disponible

        fetch('../controller/restarcantidad.php?id=' + productId)

        .then(response => response.text())

        .then(data => {

            // Verificar si la operación fue exitosa y mostrar un mensaje

            if (data.includes('correctamente')) {

                alert('Cantidad restada correctamente.');

            } else {

                alert('Error al restar la cantidad disponible del producto.');

            }

        })

        .catch(error => console.error('Error al restar la cantidad disponible:', error));

    }

});

