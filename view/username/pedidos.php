<?php 
    require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/modelPedido.php");
    require_once "/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/controller/pedidoController.php";
    require_once("../head/head.php");
    require_once("../../config/db.php");
?>

<div class="container">
        <h1 class="mt-5 mb-4">Pedidos del Cliente</h1>
        <?php
        // Crear una instancia del controlador y del modelo
        $pdo = new PDO('mysql:host=sql207.byethost7.com;dbname=b7_35756203_trabajofinal1;charset=utf8', 'b7_35756203', 'mariaunpajote1'); // Ajusta esto según tu configuración de base de datos
        $pedidosController = new PedidoController($pdo);
        $pedidoModel = new PedidoModel($pdo);
        $idUsuario = $_SESSION['usuario']['id'] ?? null;
        // Obtener los pedidos del cliente actual
        $pedidos = $pedidosController->mostrarPedidosUsuario($idUsuario);

        // Verificar si hay pedidos para mostrar
        if (!empty($pedidos)) {
            foreach ($pedidos as $pedido) {
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pedido Nº<?php echo $pedido['id_pedido']; ?></h5>
                        <p class="card-text">Fecha del Pedido: <?php echo $pedido['fecha_pedido']; ?></p>
                        <p class="card-text">Total: <?php echo $pedido['total']; ?>€</p>
                        <a href="detalles_pedido.php?id=<?php echo $pedido['id_pedido']; ?>" class="btn  btn-outline-dark">Ver detalles del pedido</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No hay pedidos para mostrar.</p>";
        }
        ?>
    </div>


</body>
</html>
<?php
require_once("../head/footer.php");
?>