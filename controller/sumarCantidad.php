<?php

// Incluir el modelo de usuario para acceder a la lógica de negocio

require_once("/model/usernameModel.php");



// Verificar si se proporcionó un ID válido

if (isset($_POST['id'])) {

    // Crear una instancia del modelo de usuario

    $model = new usernameModel();

    

    // Obtener el producto por su ID

    $producto = $model->obtenerProductoPorId($_POST['id']);

    if ($producto) {

        // Incrementar la cantidad disponible del producto

        $nuevaCantidad = $producto['cantidad'] + 1;

        // Actualizar la cantidad en la base de datos

        $resultado = $model->actualizarCantidad($_POST['id'], $nuevaCantidad);

        if ($resultado) {

            // Operación exitosa

            echo "Cantidad sumada correctamente.";

        } else {

            // Error al actualizar la cantidad

            echo "Error al actualizar la cantidad disponible del producto.";

        }

    } else {

        // Producto no encontrado

        echo "Error: Producto no encontrado.";

    }

} else {

    echo "Error: No se proporcionó un ID de producto válido.";

}

?>

