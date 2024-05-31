
<?php 
require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/modelPedido.php");
require_once "/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/controller/pedidoController.php";
require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/vercarritoModel.php");
require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/controller/usernameController.php");
require_once("../head/head.php");
require_once("../../config/db.php");

// Crear una instancia de la conexión a la base de datos
$con = new db();
$pdo = $con->conexion();

// Crear una instancia del modelo de pedido
$pedidoModel = new PedidoModel($pdo);
$usernameController = new usernameController();

// Obtener el ID del pedido (puedes obtenerlo de la URL u otra fuente)
$pedidoId = $_GET['id'] ?? null;

// Obtener detalles del pedido por su ID
$pedidoDetalles = $pedidoModel->obtenerDetallesPedido($pedidoId);

// Verificar si se encontraron detalles del pedido
if ($pedidoDetalles) {
    // Verificar si la columna 'detalles_carrito' contiene un JSON válido
    if (!empty($pedidoDetalles['detalles_carrito'])) {
        // Decodificar el JSON de los detalles del carrito una sola vez
        $detallesCarrito = json_decode($pedidoDetalles['detalles_carrito'], true);

        // Verificar si la decodificación fue exitosa
        if ($detallesCarrito !== null) {
            // Crear un array para almacenar la cantidad de cada producto
            $productosAgrupados = array();

            // Inicializar el total de la compra
            $totalCompra = 0;

            // Iterar sobre los detalles del carrito y agrupar los productos
            foreach ($detallesCarrito as $producto) {
                $productoId = $producto['producto_id'];

                // Verificar si el producto ya está en el array $productosAgrupados
                if (isset($productosAgrupados[$productoId])) {
                    // Incrementar la cantidad si ya existe
                    $productosAgrupados[$productoId]['cantidad']++;
                } else {
                    // Obtener detalles del producto por su ID
                    $productoDetalles = $usernameController->obtenerProductoPorId($productoId);
                    // Agregar el producto al array si no existe
                    $productosAgrupados[$productoId] = array(
                        'cantidad' => 1,
                        'detalles' => $productoDetalles
                    );
                }

                // Calcular el subtotal para este producto y sumarlo al total de la compra
                $subtotalProducto = $productosAgrupados[$productoId]['cantidad'] * $productoDetalles['precio'];
                $totalCompra += $subtotalProducto;
            }

            // Mostrar los productos agrupados y el total de la compra
            ?>
            <div class="d-flex justify-content-center align-items-center">
                <h2>Detalles Pedido</h2>
            </div>
            <?php
            foreach ($productosAgrupados as $productoId => $producto) {
                $productoDetalles = $producto['detalles'];
                ?>
            <div class="container">
                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="imagenes/<?php echo $productoDetalles['imagen']; ?>" class="img-fluid rounded-3 me-3" alt="Shopping item" style="width: 80px;">
                            <div>
                                <h4 class="mb-0 text-decoration-underline"><?php echo $productoDetalles['nombre']; ?></h4>
                                <p class="fw-bold mb-0">Cantidad: X<?php echo $producto['cantidad']; ?></p>
                                <a href="#!" class="text-decoration-none"><i class="fas fa-trash-alt text-danger"></i></a>
                                <p class="mb-0">Precio: <?php echo $productoDetalles['precio']; ?>€</p>
                            </div>
                        </div>
                        <div class="text-end">
                        </div>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
            <div class="container mt-4 bg-light p-3">
                <p class="fw-bold">Dirección de Entrega: <?php echo $pedidoDetalles['direccion_entrega']; ?></p>
                <p class="fw-bold">Nombre y Apellidos: <?php echo $pedidoDetalles['nombreCompleto']; ?></p>
                <p class="fw-bold">Fecha Entrega Aproximada: <?php echo $pedidoDetalles['fecha_entrega']; ?></p>
                <p class="fw-bold">Total de la Compra: <?php echo $totalCompra; ?>€</p>
                <p class="fw-bold">Costo de Envío: 20€</p>
                <p class="fw-bold">Total a Pagar: <?php echo ($totalCompra + 20); ?>€</p>
            </div>
            <?php
        } else {
            echo "<p>Error al decodificar los detalles del carrito.</p>";
            // Aquí puedes agregar más detalles sobre el error
        }
    } else {
        echo "<p>No se encontraron detalles del carrito para este pedido.</p>";
    }
} else {
    echo "<p>No se encontraron detalles para el pedido con ID: " . $pedidoId . "</p>";
}
?>
<?php
require_once("../head/footer.php");
?>
