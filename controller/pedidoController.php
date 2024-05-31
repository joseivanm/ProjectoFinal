<?php
require_once('/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/modelPedido.php');

class PedidoController {
    private $pedidoModel;

    public function __construct(PDO $conexion) {
        $this->pedidoModel = new PedidoModel($conexion);
    }

    public function mostrarPedidosUsuario($usuarioId) {
        $pedidos = $this->pedidoModel->obtenerPedidosPorUsuario($usuarioId);
        // Aquí puedes retornar los datos para ser utilizados en la vista
        return $pedidos;
    }
    
    public function mostrarTodosLosPedidos() {
        $pedidos = $this->pedidoModel->obtenerTodosPedidos();
        // Aquí puedes retornar los datos para ser utilizados en la vista
        return $pedidos;
    }

    public function cambiarEstadoPedido($productoId, $nuevoEstado) {
        // Llama al método en el modelo para cambiar el estado del pedido
        return $this->pedidoModel->cambiarEstadoPedido( $productoId, $nuevoEstado);
    }
}
?>
