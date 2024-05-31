<?php
class PedidoModel {
    private $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    public function crearPedido($usuarioId, $detallesCarritoJSON, $totalPedido, $direccionCompleta,$nombreCompleto) {
        try {
            // Calcula la fecha de entrega (5 días después de la fecha actual)
            $fechaPedido = date("Y-m-d H:i:s");
            $fechaEntrega = date("Y-m-d H:i:s", strtotime($fechaPedido . " +5 days"));
            $estado = 'procesando';
            
            // Prepara y ejecuta la consulta para insertar el pedido en la base de datos
            $stmt = $this->conexion->prepare("INSERT INTO pedidos (id_usuario, fecha_pedido, fecha_entrega, detalles_carrito, total, direccion_entrega, estado, nombreCompleto) VALUES (:usuario_id, :fecha_pedido, :fecha_entrega, :detalles_carrito, :totalPedido, :direccionCompleta, :estado, :nombreCompleto)");
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->bindParam(':fecha_pedido', $fechaPedido);
            $stmt->bindParam(':fecha_entrega', $fechaEntrega);
            $stmt->bindParam(':detalles_carrito', $detallesCarritoJSON);
            $stmt->bindParam(':totalPedido', $totalPedido);
            $stmt->bindParam(':direccionCompleta', $direccionCompleta);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':nombreCompleto', $nombreCompleto);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error al crear pedido22: ' . $e->getMessage());
            return false;
        }
    }
    public function obtenerPedidosPorUsuario($usuarioId) {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM pedidos WHERE id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener pedidos: ' . $e->getMessage());
            return false;
        }
    }

    public function obtenerDetallesPedido($pedidoId) {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM pedidos WHERE id_pedido = :pedido_id");
            $stmt->bindParam(':pedido_id', $pedidoId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch en vez de fetchAll, ya que se espera solo un resultado
        } catch (PDOException $e) {
            error_log('Error al obtener detalles del pedido: ' . $e->getMessage());
            return false;
        }
    }
    public function obtenerTodosPedidos() {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM pedidos ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener pedidos: ' . $e->getMessage());
            return false;
        }
    }

    public function cambiarEstadoPedido($pedidoId, $nuevoEstado) {
        try {
            $stmt = $this->conexion->prepare("UPDATE pedidos SET estado = :estado WHERE id_pedido = :pedido_id");
            $stmt->bindParam(':estado', $nuevoEstado);
            $stmt->bindParam(':pedido_id', $pedidoId);
            $stmt->execute();
            return true;
        
        } catch (PDOException $e) {
            error_log('Error al obtener pedidos: ' . $e->getMessage());
            return false;
        }
    }


    // Otros métodos relacionados con pedidos según tus necesidades
}
?>
