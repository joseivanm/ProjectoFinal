<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../model/modelPedido.php');
require_once('../model/modelCarrito.php');

$dsn = 'mysql:host=sql207.byethost7.com;dbname=b7_35756203_trabajofinal1;charset=utf8';
$usuario = 'b7_35756203';
$contrasena = 'mariaunpajote1';

try {
    $conexion = new PDO($dsn, $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Error de conexión a la base de datos: ' . $e->getMessage());
    echo "Error de conexión a la base de datos.";
    exit;
}

$pedidoModel = new PedidoModel($conexion);
$carritoModel = new CarritoModel($conexion);
$totalPedido = $_POST['total_pedido'];

if (isset($_SESSION['usuario']['id'])) {
    $usuarioId = $_SESSION['usuario']['id'];
    $direccion = $_SESSION['usuario']['direccion'];
    $poblacion = $_SESSION['usuario']['provincia'];
    $provincia = $_SESSION['usuario']['poblacion'];
    $codigoPostal = $_SESSION['usuario']['codigoPostal'];
    $nombre = $_SESSION['usuario']['nombre'];
    $apellido1 = $_SESSION['usuario']['apellido1'];
    $apellido2 = $_SESSION['usuario']['apellido2'];


    $direccionCompleta = $direccion. ", ". $poblacion. ", ". $provincia. ", ". $codigoPostal;
    $nombreCompleto= $nombre. " ". $apellido1. " ". $apellido2;
    // Obtener los detalles del carrito para el usuario actual
    $detallesCarrito = $carritoModel->obtenerContenidoDelCarrito($usuarioId);
    
    // Convertir los detalles del carrito a formato JSON
    $detallesCarritoJSON = json_encode($detallesCarrito);
    
    // Crear el pedido con los detalles del carrito
    $pedidoCreado = $pedidoModel->crearPedido($usuarioId, $detallesCarritoJSON,$totalPedido,$direccionCompleta,$nombreCompleto);
    
    if ($pedidoCreado) {
        // Limpiar el carrito después de crear el pedido
        $carritoModel->vaciarCarrito($usuarioId);
        header("Location: ../view/username/pedidocreado.php");
    } else {
        print_r($_SESSION['usuario']);
        echo "Error al VaciarCarrito.". $usuarioId ."+". $detallesCarritoJSON, $totalPedido, $direccionCompleta,$nombreCompleto;
    }
} else {
    echo "Usuario no autenticado.";
}
?>
