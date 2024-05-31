<?php
require_once("../../config/db.php");
require_once("../../model/verCarritoModel.php");
require_once("../../controller/usernameController.php");

class VerCarritoController
{
    private $carritoModel;

    public function __construct()
    {
        $con = new db();
        $pdo = $con->conexion();
        $this->carritoModel = new CarritoModel($pdo);
    }

    // Método para obtener los detalles del carrito
    public function obtenerDetallesCarrito()
    {
        // Lógica para obtener los detalles del carrito desde el modelo
        $detallesCarrito = $this->carritoModel->obtenerDetallesCarrito();

        // Instancia de usernameController para obtener detalles de cada producto
        $usernameController = new usernameController();

        // Obtén los detalles del producto para cada producto en el carrito
        foreach ($detallesCarrito as &$producto) {
            $detallesProducto = $usernameController->obtenerProductoPorId($producto['producto_id']);

            // Agrega los detalles del producto al array del carrito
            $producto['detalles'] = $detallesProducto;
        }

        // Devuelve los detalles del carrito
        return $detallesCarrito;
    }

    // Método para mostrar los detalles del carrito como JSON
    public function mostrarDetallesCarrito()
    {
        // Obtener detalles del carrito
        $detallesCarrito = $this->obtenerDetallesCarrito();

        // Devolver detalles del carrito como JSON
        header('Content-Type: application/json');
        echo json_encode(array('detalles' => $detallesCarrito));
    }
    // Método para obtener los detalles del carrito por usuario
    public function obtenerDetallesCarritoPorUsuario($idUsuario)
    {
        // Lógica para obtener los detalles del carrito por usuario desde el modelo
        $detallesCarrito = $this->carritoModel->obtenerDetallesCarritoPorUsuario($idUsuario);

        // Instancia de usernameController para obtener detalles de cada producto
        $usernameController = new usernameController();

        // Obtén los detalles del producto para cada producto en el carrito
        foreach ($detallesCarrito as &$producto) {
            $detallesProducto = $usernameController->obtenerProductoPorId($producto['producto_id']);

            // Agrega los detalles del producto al array del carrito
            $producto['detalles'] = $detallesProducto;
        }

        // Devuelve los detalles del carrito
        return $detallesCarrito;
    }

    // Método para mostrar los detalles del carrito como JSON
    public function mostrarDetallesCarritoPorUsuario($idUsuario)
    {
        // Obtener detalles del carrito por usuario
        $detallesCarrito = $this->obtenerDetallesCarritoPorUsuario($idUsuario);

        // Devolver detalles del carrito como JSON
        header('Content-Type: application/json');
        echo json_encode(array('detalles' => $detallesCarrito));
    }

}

// Crear una instancia del controlador
$verCarritoController = new VerCarritoController();

// Obtener el id del usuario actual (puedes obtenerlo de tu lógica de sesión)
$idUsuario = $_SESSION['usuario']['id'] ?? null;

// Llamar al método para mostrar los detalles del carrito
$verCarritoController->mostrarDetallesCarrito();

// Llamar al método para mostrar los detalles del carrito por usuario
$verCarritoController->mostrarDetallesCarritoPorUsuario($idUsuario);
?>
