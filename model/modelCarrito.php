<?php
require_once('usernameController.php');
require_once('../model/usernameModel.php');
class CarritoModel {
    private $conexion;
    private $usernameModel; // Agrega una propiedad para almacenar el objeto usernameModel

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
        $this->usernameModel = new usernameModel(); // Crea un objeto usernameModel en el constructor
    }

    public function agregarProductoAlCarrito($productoId, $usuarioId) {
        try {
            //$stmt = $this->conexion->prepare("DELETE FROM carrito WHERE producto_id = 15 AND usuario_id = 7 LIMIT 2");
            
            $stmt = $this->conexion->prepare("INSERT INTO carrito (producto_id, usuario_id) VALUES (:producto_id, :usuario_id)");
            $stmt->bindParam(':producto_id', $productoId);
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error al agregar producto al carrito: ' . $e->getMessage());
            return false;
        }
    }

    public function obtenerContenidoDelCarrito($usuarioId) {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM carrito WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener contenido del carrito: ' . $e->getMessage());
            return false;
        }
    }

    public function vaciarCarrito($usuarioId) {

        try {
        $carrito = $this->obtenerContenidoDelCarrito($usuarioId);

        // Iterar sobre los productos en el carrito
        foreach ($carrito as $item) {
        $productoId = $item['producto_id'];
        // Restar la cantidad del stock
        $this->usernameModel->restarCantidad($productoId);
        }

    // Vaciar el carrito
        //$carritoModel->vaciarCarrito($idUsuario);
            $stmt = $this->conexion->prepare("DELETE FROM carrito WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error al vaciar el carrito: ' . $e->getMessage());
            return false;
        }
    }
    public function restarProductoDelCarrito($productoId, $usuarioId) {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM carrito WHERE producto_id = :producto_id AND usuario_id = :usuario_id LIMIT 1");
            $stmt->bindParam(':producto_id', $productoId);
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error al restar producto del carrito: ' . $e->getMessage());
            return false;
        }
    }
    

    // Puedes agregar más funciones relacionadas con el carrito según tus necesidades
}
/*class CarritoModel {
    private $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    public function agregarProductoAlCarrito($productoId, $usuarioId) {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO carrito (producto_id, usuario_id) VALUES (:producto_id, :usuario_id)");
            $stmt->bindParam(':producto_id', $productoId);
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error al agregar producto al carrito: ' . $e->getMessage());
            return false;
        }
    }

    public function obtenerContenidoDelCarrito($usuarioId) {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM carrito WHERE usuario_id = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener contenido del carrito: ' . $e->getMessage());
            return false;
        }
    }

    // Puedes agregar más funciones relacionadas con el carrito según tus necesidades
}*/

?>
