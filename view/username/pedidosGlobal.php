<?php 
require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/modelPedido.php");
require_once "/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/controller/pedidoController.php";
require_once("../head/head.php");
require_once("../../config/db.php");
?>

<div class="container">
    <h1 class="mt-5 mb-4">Pedidos todos usuarios</h1>
    <?php
    // Crear una instancia del controlador y del modelo
    $pdo = new PDO('mysql:host=localhost;dbname=trabajofinal;charset=utf8', 'root', ''); // Ajusta esto según tu configuración de base de datos
    $pedidosController = new PedidoController($pdo);
    $pedidoModel = new PedidoModel($pdo);

    // Obtener todos los pedidos
    $pedidos = $pedidosController->mostrarTodosLosPedidos();

    // Verificar si hay pedidos para mostrar
    if (!empty($pedidos)) {
        foreach ($pedidos as $pedido) {
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pedido Nº<?php echo $pedido['id_pedido']; ?></h5>
                    <p class="card-text">Nombre Completo: <?php echo $pedido['nombreCompleto']; ?></p>
                    <p class="card-text">ID USUARIO: <?php echo $pedido['id_usuario']; ?></p>
                    <p class="card-text">Fecha del Pedido: <?php echo $pedido['fecha_pedido']; ?></p>
                    <p class="card-text">ESTADO: <b><?php echo $pedido['estado']; ?></b></p>
                    <p class="card-text">Total: <?php echo $pedido['total']; ?>€</p>
                    <a href="detalles_pedido.php?id=<?php echo $pedido['id_pedido']; ?>" class="btn  btn-outline-dark">Ver detalles del pedido</a>
                    <button type="button" class="btn  btn-outline-dark" data-toggle="modal" data-target="#cambiarEstadoModal<?php echo $pedido['id_pedido']; ?>">
                        Cambiar Estado
                    </button>
                    
                </div>
            </div>
            <div class="modal fade" id="cambiarEstadoModal<?php echo $pedido['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoModalLabel<?php echo $pedido['id_pedido']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarEstadoModalLabel<?php echo $pedido['id_pedido']; ?>">Cambiar Estado del Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Selecciona el nuevo estado para el pedido:</p>
                <div class="form-group">
                    <select class="form-control" id="nuevoEstado<?php echo $pedido['id_pedido']; ?>">
                        <option value="Procesando">Procesando</option>
                        <option value="Enviado">Enviado</option>
                        <option value="Entregado">Entregado</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <!-- Botón para confirmar cambio de estado -->
                <button type="button" class="btn btn-success" onclick="confirmarCambioEstado(<?php echo $pedido['id_pedido']; ?>)">Confirmar</button>
            </div>
        </div>
    </div>
</div>
            <?php
        }
    } else {
        echo "<p>No hay pedidos para mostrar.</p>";
    }
    ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G6Z1Nj1z9z/HtlNzo4sF4JmCuFE8C2Jv8jVo" crossorigin="anonymous">


<footer class="bg-dark text-white py-4">
    
</footer>

 
</body>
</html>
