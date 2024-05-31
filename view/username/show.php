<?php

require_once("../head/head.php");

require_once("../../controller/usernameController.php");

require_once("../../config/db.php");

require_once("../../model/verCarritoModel.php");

require_once("../../controller/usernameController.php");



// Crea una instancia del controlador

$obj = new usernameController();

$con = new db();

$pdo = $con->conexion();

$date = $obj->show($_GET['id']);

$idProducto= $_GET['id'];



// Crear una instancia del modelo de carrito

$carritoModel = new CarritoModel($pdo);



// Obtiene los detalles del usuario basados en la matrícula proporcionada a través de $_GET



////////////////////////////////////







//$rows = $obj->index();







$idUsuario = $_SESSION['usuario']['id'] ?? null;





// Obtiene los productos en el carrito para el usuario actual

$productosEnCarrito = $carritoModel->obtenerDetallesCarritoPorUsuario($idUsuario);



// Crea un array para almacenar la cantidad de cada producto en el carrito

$cantidadProductosEnCarrito = array();



// Itera sobre los productos en el carrito y cuenta la cantidad de cada producto

foreach ($productosEnCarrito as $producto) {

    $productoId = $producto['producto_id'];

    // Incrementa la cantidad si el producto ya está en el carrito

    if (isset($cantidadProductosEnCarrito[$productoId])) {

        $cantidadProductosEnCarrito[$productoId]++;

    } else {

        // Agrega el producto al array si no existe

        $cantidadProductosEnCarrito[$productoId] = 1;

    }

}

$cantidadDisponible = isset($cantidadProductosEnCarrito[$idProducto]) ? ($date["cantidad"] - $cantidadProductosEnCarrito[$idProducto]) : $date["cantidad"];

?>



<!-- Sección para mostrar detalles del registro -->

<div class="container">

    <h2 class="text-center mt-4 mb-3">Detalles del Producto</h2>



    <div class="row">

        <!-- Imagen del producto -->

        <div class="col-md-6">

            <img class="img-fluid rounded" src="imagenes/<?= $date['imagen'] ?>" alt="Imagen del producto">

        </div>



        <!-- Detalles del producto -->

        <div class="col-md-6">

            <table class="table">

                <tbody>

                    <tr>

                        <th scope="row">Nombre:</th>

                        <td><?= $date["nombre"] ?></td>

                    </tr>

                    <tr>

                        <th scope="row">Disponible:</th>

                        <td>

                            <?php if ($date["disponible"] == 1 && $cantidadDisponible > 0) : ?>

                                <span class="badge bg-success">Disponible</span>

                            <?php else : ?>

                                <span class="badge bg-danger">No Disponible</span>

                            <?php endif; ?>

                        </td>

                    </tr>

                    <tr>



                        <th scope="row">Cantidad:</th>

                        <td><?= $cantidadDisponible?></td>

                    </tr>

                    <tr>

                        <th scope="row">Precio:</th>

                        <td><?= $date["precio"] ?></td>

                    </tr>

                    <tr>

                        <th scope="row">Descripción:</th>

                        <td><?= $date["descripcion"] ?></td>

                    </tr>

                </tbody>

            </table>

            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

                <div class="text-center">

                    <?php if ($date["disponible"] == 1 && $cantidadDisponible > 0) : ?>

                        <?php if (isset($_SESSION['usuario'])) : ?>

                            <button class="btn btn-outline-dark mt-auto btn-add-to-cart" data-product-id="<?= $date[0] ?>">Añadir al Carrito</button>

                        <?php endif; ?>

                    <?php else : ?>

                        <div class="alert alert-warning" role="alert">

                            Este producto no está disponible actualmente.

                        </div>

                    <?php endif; ?>

                    <!-- Enlace para volver -->

                    <a href="index.php" class="btn btn-outline-dark mt-auto ">Volver</a>

                </div>

            </div>

        </div>

    </div>

</div>



<?php

require_once("../head/footer.php");

?>

