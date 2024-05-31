function confirmarCambioEstado(pedidoId) {

    var nuevoEstado = document.getElementById('nuevoEstado' + pedidoId).value;

    var data = "idEnvio="+encodeURIComponent(pedidoId)+"&estado=" + encodeURIComponent(nuevoEstado);



    // Llamada AJAX para agregar el producto al carrito

    var xhr = new XMLHttpRequest();

    xhr.open("POST", "/controller/cambiarEstadoPedido.php", true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



    // Configurar el manejador de eventos onload para manejar la respuesta del servidor

    xhr.onload = function () {

        if (xhr.status === 200) {

            

        location.reload(); // Recargar la página para reflejar los cambios

             

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

    /*var nuevoEstado = document.getElementById('nuevoEstado' + pedidoId).value;



    // Llamada AJAX para cambiar el estado del pedido

    var xhr = new XMLHttpRequest();

    xhr.open('POST', '/controller/cambiarEstadoPedido.php', true);

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');



    xhr.onload = function () {

        if (xhr.status === 200) {

            alert(encodeURIComponent(nuevoEstado));

            // Manejar la respuesta del servidor si es necesario

            //alert('pedidoId=' + encodeURIComponent(pedidoId) + '&nuevoEstado=' + encodeURIComponent(nuevoEstado));

            location.reload(); // Recargar la página para reflejar los cambios

        } else {

            alert('Error al cambiar el estado del pedido');

        }

    };



    xhr.onerror = function () {

        alert('Error de red al cambiar el estado del pedido');

    };



    xhr.send('pedidoId=24&nuevoEstado=bien');

    //xhr.send('pedidoId=' + encodeURIComponent(pedidoId) + '&nuevoEstado=' + encodeURIComponent(nuevoEstado));*/

}



