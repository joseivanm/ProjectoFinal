<?php

// obtenerNumeroProductosCarrito.php



// Incluir los archivos necesarios y realizar las instancias

require_once("../config/db.php");

require_once("../model/verCarritoModel.php");

require_once("usernameController.php");



// Crear una instancia de la conexión a la base de datos

$con = new db();

$pdo = $con->conexion();



// Crear una instancia del modelo de carrito

$carritoModel = new CarritoModel($pdo);



// Obtener el id del usuario actual

$idUsuario = $_SESSION['usuario']['id'] ?? null;



// Obtener detalles del carrito para el usuario actual

$detallesCarrito = $carritoModel->obtenerDetallesCarritoPorUsuario($idUsuario);



// Contar la cantidad total de productos en el carrito

$cantidadTotalProductos = count($detallesCarrito);



// Devolver la cantidad total de productos en el carrito

echo $cantidadTotalProductos;

?>

