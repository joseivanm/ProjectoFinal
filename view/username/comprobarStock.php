<?php 
require_once("../head/head.php");
require_once("../../config/db.php");
require_once("../../model/vercarritoModel.php");
require_once("../../controller/usernameController.php");





// Crear una instancia de la conexión a la base de datos
$con = new db();
$pdo = $con->conexion();

// Crear una instancia del modelo de carrito
$carritoModel = new CarritoModel($pdo);

// Crear una instancia del controlador de username
$usernameController = new usernameController();

// Obtener el id del usuario actual (puedes obtenerlo de tu lógica de sesión)
$idUsuario = $_SESSION['usuario']['id'] ?? null;

// Obtener detalles del carrito para el usuario actual
$detallesCarrito = $carritoModel->obtenerDetallesCarritoPorUsuario($idUsuario);

// Crear un array para almacenar la cantidad de cada producto
$cantidadProductos = array();

// Inicializar la variable para el total de la compra
$totalCompra = 0;

// Iterar sobre los detalles del carrito y contar la cantidad de cada producto
foreach ($detallesCarrito as $detalle) {
    $productoId = $detalle['producto_id'];

    // Verificar si el producto ya está en el array $cantidadProductos
    if (isset($cantidadProductos[$productoId])) {
        // Incrementar la cantidad si ya existe
        $cantidadProductos[$productoId]['cantidad']++;
    } else {
        // Agregar el producto al array si no existe
        $productoDetalles = $usernameController->obtenerProductoPorId($productoId);
        $cantidadProductos[$productoId] = array(
            'cantidad' => 1,
            'detalles' => $productoDetalles
        );
    }

    // Calcular el subtotal para este producto y sumarlo al total de la compra

}
?>
