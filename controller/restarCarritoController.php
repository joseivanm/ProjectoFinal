<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

$carritoModel = new CarritoModel($conexion);

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'agregar' && isset($_POST['producto'])) {
        $productoId = $_POST['producto'];
        $usuarioId = $_SESSION['usuario']['id'];
        
        if ($carritoModel->restarProductoDelCarrito($productoId, $usuarioId)) {
            echo "Producto agregado al carrito12";
        } else {
            echo "Error al agregar el producto al carrito". $productoId . "+".$usuarioId;
        }
    } elseif ($_POST['action'] == 'mas' && isset($_POST['producto_id'])) {
        $productoId = $_POST['producto_id'];
        $usuarioId = $_SESSION['usuario']['id'];
        
        if ($carritoModel->agregarProductoAlCarrito($productoId, $usuarioId)) {
            // Redirige a la página actual para refrescar
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error al agregar más cantidad del producto al carrito". $productoId . "+".$usuarioId;
        }
    } elseif ($_POST['action'] == 'menos' && isset($_POST['producto_id'])) {
        $productoId = $_POST['producto_id'];
        $usuarioId = $_SESSION['usuario']['id'];
        
        // Decrementar la cantidad del producto en el carrito
        if ($carritoModel->restarProductoDelCarrito($productoId, $usuarioId)) {
            // Redirige a la página actual para refrescar
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error al eliminar una unidad del producto del carrito". $productoId . "+".$usuarioId;
        }
    }

    // Otras lógicas según tus necesidades (mostrar contenido del carrito, eliminar producto, etc.)
}

?>
