<?php


require_once('../model/modelCarrito.php');
require_once('pedidoController.php');

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
$pedidoController = new PedidoController($conexion);

// Intentar cambiar el estado del pedido


//$carritoModel = new CarritoModel($conexion);


    
        $productoId = $_POST['idEnvio'];
        $nuevoEstado = $_POST['estado'];
        
        
        $resultado = $pedidoController->cambiarEstadoPedido($productoId, $nuevoEstado)


    
    

    // Otras lógicas según tus necesidades (mostrar contenido del carrito, eliminar producto, etc.)



/* Verificar si se recibieron los datos necesarios
// Incluir el controlador de pedidos
require_once('pedidoController.php');
// Incluir el archivo de configuración de la base de datos
require_once('../config/db.php');


if (isset($_POST['pedidoId']) && isset($_POST['nuevoEstado'])) {
    $pedidoId = $_POST['pedidoId'];
    $nuevoEstado = $_POST['nuevoEstado'];


    // Crear una instancia del controlador de pedidos
    $pedidoController = new PedidoController($pdo);

    // Intentar cambiar el estado del pedido
    $resultado = $pedidoController->cambiarEstadoPedido($pedidoId, $nuevoEstado);

    if ($resultado) {
        // El estado del pedido se cambió con éxito
        echo "Estado del pedido cambiado correctamente";
    } else {
        // Hubo un error al cambiar el estado del pedido
        echo "Error al cambiar el estado del pedido";
    }
} else {
    // Si no se recibieron los datos necesarios, mostrar un mensaje de error
    echo "Datos insuficientes para cambiar el estado del pedido";
}*/
?>
