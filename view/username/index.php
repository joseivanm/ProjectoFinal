<?php

// Incluye los archivos necesarios

require_once("../head/head.php");

require_once("../../controller/usernameController.php");

require_once("../../config/db.php");

require_once("../../model/verCarritoModel.php");

require_once("../../controller/usernameController.php");



// Crea una instancia del controlador de username

$obj = new usernameController();

$con = new db();

$rows = $obj->index();



$pdo = $con->conexion();



// Crear una instancia del modelo de carrito

$carritoModel = new CarritoModel($pdo);



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

?>



<!-- Comienza el HTML -->

<!DOCTYPE html>

<html lang="es">

<head>

    <!-- Coloca aquí tu encabezado, como metaetiquetas, títulos y enlaces a archivos CSS -->

</head>

<body>



<!-- Agrega aquí tu contenido HTML, como encabezados, navegación y contenido de la página -->

<div class="clearfix"></div>



<style>

    .imagen-producto {

        max-width: 100%;

        height: 200px; /* Ajusta la altura deseada */

        object-fit: cover; /* Mantiene la proporción y corta si es necesario */

    }

    .container {

    position: relative; /* Asegura que otros elementos en el contenedor principal mantengan su posición relativa al contenedor */

    z-index: 1; /* Asegura que los elementos en el contenedor principal estén por encima del slider */

    }



    section.py-5 {

        margin-top: 100px; /* Ajusta el valor del margen superior según sea necesario */

    }



</style>



<link rel="stylesheet" href="slider.css">



<div class="container px-7 px-lg-10 my-5 ">

    <div class="text-center text-black">

        <h1 class="display-4 fw-bolder">Huerto Ecológico</h1>

        <p class="lead fw-normal text-black-50 mb-0">Del Campo a la Mesa</p>

    </div>

</div>



<div id="slider-container" >

    <!-- Aquí va el contenido del slider -->

    <ul class="slider">

            <li id="slide1">

                <img src="slider/article.jpg" />

            </li>

            <li id="slide2">

                <img src="slider/iStock.jpg" />

            </li>

            <li id="slide3">

                <img src="slider/jjj.jpg" />

            </li>

        </ul>

</div>





<section class="py-5">

    <div class="container px-7 px-lg-10 my-5 ">

        <div class="text-center text-black">

            <h1 class="display-4 fw-bolder">Nuestros Productos</h1>

        </div>

    </div>

    <div class="container px-4 px-lg-5 mt-5">

    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php if ($rows): ?>

                <?php foreach ($rows as $row): ?>

                <?php if ($row[9] !== 'eliminado'): ?>

                    <div class="col mb-5">

                        <div class="card h-100"style="background-color:  #FCF9EC;">

                            <?php if (!empty($row['imagen'])): ?>

                                <img class="card-img-top imagen-producto" src="imagenes/<?= $row['imagen'] ?>" alt="Imagen del producto" />

                            <?php endif; ?>

                            <div class="card-body p-4">

                                <div class="text-center">

                                    <h5 class="fw-bolder"><?= $row[1]?></h5>

                                    

                                    <p>Disponible: <?= isset($cantidadProductosEnCarrito[$row[0]]) ? ($row[2] - $cantidadProductosEnCarrito[$row[0]]) : $row[2] ?></p>

                                    <p>Precio: <?= $row[3] ?>.€</p>

                                </div>

                            </div>

                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

                                <div class="text-center">

                                    <a class="btn btn-outline-dark mt-auto" href="show.php?id=<?= $row[0] ?>">Ver</a>

                                    <?php

                                    // Verifica si el producto está en el carrito

                                    $productoId = $row[0];

                                    $cantidadEnCarrito = isset($cantidadProductosEnCarrito[$productoId]) ? $cantidadProductosEnCarrito[$productoId] : 0;

                                    // Calcula la cantidad disponible restando la cantidad en el carrito de la cantidad total

                                    $cantidadDisponible = $row[2] - $cantidadEnCarrito;

                                    if (isset($_SESSION['usuario'])){ 

                                        if ($cantidadDisponible > 0) {

                                            // Si hay cantidad disponible, muestra el botón para agregar al carrito

                                            echo '<button class="btn btn-outline-dark mt-auto btn-add-to-cart" data-product-id="'. $row[0] .'">Añadir al Carrito</button>';

                                         

                                        } else {

                                            // Si no hay cantidad disponible, muestra un mensaje indicando que no hay existencias

                                            echo '<button class="btn btn-outline-dark mt-auto" disabled>Sin Existencias</button>';

                                        }

                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-md-12">

                    <p class="center">No hay registros</p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>





<?php require_once("../head/footer.php"); ?>



</body>

</html>

