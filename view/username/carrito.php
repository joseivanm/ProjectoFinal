<?php

// carrito.php

require_once("../head/head.php");

require_once("../../config/db.php");

require_once("../../model/verCarritoModel.php");

require_once("../../controller/usernameController.php");



















// Crear una instancia de la conexión a la base de datos

$con = new db();

$pdo = $con->conexion();



// Crear una instancia del modelo de carrito

$carritoModel = new CarritoModel($pdo);



// Crear una instancia del controlador de username

$usernameController = new usernameController();

//instancia para cargar todos los productos

$obj = new usernameController();

//llamar al metodo para cargar los objetos

$rows = $obj->index();



// Obtener el id del usuario actual (puedes obtenerlo de tu lógica de sesión)

$idUsuario = $_SESSION['usuario']['id'] ?? null;



// Obtener detalles del carrito para el usuario actual

$detallesCarrito = $carritoModel->obtenerDetallesCarritoPorUsuario($idUsuario);



// Crear un array para almacenar la cantidad de cada producto

$cantidadProductos = array();



// Inicializar la variable para el total de la compra

$totalCompra = 0;



// Iterar sobre los detalles del carrito y contar la cantidad de cada producto

foreach ($detallesCarrito as $detalle) {

    $productoId = $detalle['producto_id'];



    // Verificar si el producto ya está en el array $cantidadProductos

    if (isset($cantidadProductos[$productoId])) {

        // Incrementar la cantidad si ya existe

        $cantidadProductos[$productoId]['cantidad']++;

    } else {

        // Agregar el producto al array si no existe

        $productoDetalles = $usernameController->obtenerProductoPorId($productoId);

        $cantidadProductos[$productoId] = array(

            'cantidad' => 1,

            'detalles' => $productoDetalles

        );

    }



    // Calcular el subtotal para este producto y sumarlo al total de la compra

    $subtotalProducto = $cantidadProductos[$productoId]['cantidad'] * $productoDetalles['precio'];

    $totalCompra += $subtotalProducto;

}

?>





    <!-- Incluye tus estilos y scripts necesarios aquí -->

    <style>

        .h-custom {

            display: flex;

            flex-direction: column;

            min-height: 80vh;

        }



        .carrito {

            flex-grow: 1;

            background-color: #eee;

            padding: 20px;

        }



        .cantidad-btn {

            background-color: transparent;

            border: none;

            cursor: pointer;

            font-size: 1.5rem;

            color: #000;

        }



        .card-body {

            padding: 1rem;

        }



        footer {

            background-color: #333;

            color: #fff;

            padding: 20px 0;

            text-align: center;

            width: 100%;

        }



        @media (max-width: 1200px) {

            footer {

                position: relative;

            }

        }



        @media (min-width: 1200px) {

            .d-custom-block {

                display: block !important;

            }



            .d-custom-none {

                display: none !important;

            }

        }



        @media (max-width: 1199px) {

            .d-custom-block {

                display: none !important;

            }



            .d-custom-none {

                display: block !important;

            }

        }

    </style>

</head>



<body>

    <section class="h-100 h-custom" style="background-color: #eee;">

        <div class="container py-5 h-100 carrito">

            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col">

                    <div class="card">

                        <div class="card-body p-4">

                            <div class="row">

                                <!-- Mostrar modo ordenador-->

                                <div class="col-lg-7 d-none d-lg-block">

                                    <h5 class="mb-3"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>TU CARRITO</a></h5>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <div>

                                            <p class="mb-1">Carrito Compra</p>

                                            <p class="mb-0 contCuenta"> </p>

                                        </div>

                                    </div>

                                    <!-- Contenido del carrito -->

                                    <?php

                                    if (!empty($cantidadProductos)) {

                                        foreach ($cantidadProductos as $productoId => $producto) {

                                            if (isset($producto['detalles'])) {

                                                $productoDetalles = $producto['detalles'];

                                                foreach ($rows as $row) {

                                                    if ($row['id'] == $productoDetalles['id']) {

                                                        $cantidadStock = $row['cantidad'];

                                                        $stockDisponible = $cantidadStock - $producto['cantidad'];

                                                        break;

                                                    }

                                                }

                                    ?>

                                                <div class="card mb-3">

                                                    <div class="card-body">

                                                        <div class="d-flex flex-wrap justify-content-between">

                                                            <div class="d-flex flex-row align-items-center">

                                                                <div>

                                                                    <img src="<?php echo 'imagenes/' . $productoDetalles['imagen']; ?>" class="img-fluid rounded-3" alt="Shopping item" style="max-width: 100px; height: auto; margin-right: 10px;">

                                                                </div>

                                                                <div style="width: 200px;">

                                                                    <h5 class="mb-0">Producto: <?php echo $productoDetalles['nombre']; ?></h5>

                                                                </div>

                                                                <div style="width: 100px;">

                                                                    <h5 class="mb-0">Stock: <?php echo $stockDisponible ?></h5>

                                                                </div>

                                                            </div>

                                                            <div class="d-flex flex-row align-items-center">

                                                                <div style="width: 30px;">

                                                                    <button class="btn btn-down-to-cart" data-product-id="<?php echo $productoId; ?>" data-product-total="<?php echo $totalCompra; ?>" data-product-precio="<?php echo $productoDetalles['precio']; ?>" data-product-quantity="<?php echo $producto['cantidad']; ?>" <?php echo ($producto['cantidad'] <= 0) ? 'disabled' : ''; ?>>-</button>

                                                                </div>

                                                                <div style="width: 50px;">

                                                                    <h5 class="fw-normal mb-0 cantidad-<?php echo $productoId; ?>"><?php echo $producto['cantidad']; ?></h5>

                                                                </div>

                                                                <div style="width: 30px;">

                                                                    <button class="btn btn-up-to-cart" data-product-id="<?php echo $productoId; ?>" data-product-total="<?php echo $totalCompra; ?>" data-product-precio="<?php echo $productoDetalles['precio']; ?>" data-product-quantity="<?php echo $producto['cantidad']; ?>" <?php echo ($stockDisponible <= 0) ? 'disabled' : ''; ?>>+</button>

                                                                </div>

                                                                <div style="width: 200%;">

                                                                    <h5 class="mb-0"><?php echo "P.Unidad: " . $productoDetalles['precio'] . '€'; ?></h5>

                                                                </div>

                                                                <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                    <?php

                                            } else {

                                                echo "<p>Detalles no disponibles para el Producto ID: " . $productoId . "</p>";

                                            }

                                        }

                                    } else {

                                        echo "<p>Carrito vacío</p>";

                                    }

                                    ?>

                                </div>

                                <!-- Mostrar modo movil-->

                                <div class="d-block d-sm-block d-md-block d-lg-none">

                                    <h5 class="mb-3"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>TU CARRITO</a></h5>

                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <div>

                                            <p class="mb-1">Carrito Compra</p>

                                            <p class="mb-0 contCuenta"> </p>

                                        </div>

                                    </div>

                                    <?php

                                    if (!empty($cantidadProductos)) {

                                        foreach ($cantidadProductos as $productoId => $producto) {

                                            if (isset($producto['detalles'])) {

                                                $productoDetalles = $producto['detalles'];

                                                foreach ($rows as $row) {

                                                    if ($row['id'] == $productoDetalles['id']) {

                                                        $cantidadStock = $row['cantidad'];

                                                        $stockDisponible = $cantidadStock - $producto['cantidad'];

                                                        break;

                                                    }

                                                }

                                    ?>

                                                <div class="card mb-3">

                                                    <div class="card-body">

                                                        <div class="d-flex flex-column flex-md-row align-items-md-center">

                                                            <div class="d-flex flex-column flex-md-row align-items-md-center">

                                                                <div>

                                                                    <img src="<?php echo 'imagenes/' . $productoDetalles['imagen']; ?>" class="img-fluid rounded-3" alt="Shopping item" style="max-width: 100px; height: auto; margin-right: 10px;">

                                                                </div>

                                                                <div style="width: 200px;">

                                                                    <h5 class="mb-0">Producto: <?php echo $productoDetalles['nombre']; ?></h5>

                                                                </div>

                                                                <div style="width: 160px;">

                                                                    <h5 class="mb-0">Disponible: <?php echo $stockDisponible ?></h5>

                                                                </div>

                                                            </div>

                                                            <div class="d-flex flex-row align-items-center">

                                                                <div style="width: 30px;">

                                                                    <button class="btn btn-down-to-cart" data-product-id="<?php echo $productoId; ?>" data-product-total="<?php echo $totalCompra; ?>" data-product-precio="<?php echo $productoDetalles['precio']; ?>" data-product-quantity="<?php echo $producto['cantidad']; ?>" <?php echo ($producto['cantidad'] <= 0) ? 'disabled' : ''; ?>>-</button>

                                                                </div>

                                                                <div style="width: 22px;">

                                                                    <h5 class="fw-normal mb-0 cantidad-<?php echo $productoId; ?>"><?php echo $producto['cantidad']; ?></h5>

                                                                </div>

                                                                <div style="width: 10px;">

                                                                    <button class="btn btn-up-to-cart" data-product-id="<?php echo $productoId; ?>" data-product-total="<?php echo $totalCompra; ?>" data-product-precio="<?php echo $productoDetalles['precio']; ?>" data-product-quantity="<?php echo $producto['cantidad']; ?>" <?php echo ($stockDisponible <= 0) ? 'disabled' : ''; ?>>+</button>

                                                                </div>

                                                                <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>

                                                            </div>

                                                            <div class="d-flex flex-row align-items-center">

                                                                <div style="width: 400%;">

                                                                    <h5 class="mb-0"><?php echo "P.Unidad: " . $productoDetalles['precio'] . '€'; ?></h5>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                    <?php

                                            } else {

                                                echo "<p>Detalles no disponibles para el Producto ID: " . $productoId . "</p>";

                                            }

                                        }

                                    } else {

                                        echo "<p>Carrito vacío</p>";

                                    }

                                    ?>

                                </div>

                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">

                                        <div class="card-body">

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">

                                                <p class="mb-2">Subtotal</p>

                                                <p class="mb-2 subtotal"><?php echo number_format($totalCompra); ?>€</p>

                                            </div>

                                            <div class="d-flex justify-content-between">

                                                <p class="mb-2">Envio</p>

                                                <p class="mb-2">20.00€</p>

                                            </div>

                                            <div class="d-flex justify-content-between mb-4">

                                                <p class="mb-2">Total(Incl. tasas)</p>

                                                <p class="mb-2 total"><?php echo number_format($totalCompra + 20); ?>€</p>

                                            </div>

                                            <?php if (!empty($cantidadProductos)) : ?>

                                                <form action="../../controller/agregarPedido.php" method="post">

                                                    <input type="hidden" name="total_pedido" value="<?php echo number_format($totalCompra + 20); ?>">

                                                    <button type="submit" class="btn btn-info btn-block btn-lg">

                                                        <div class="d-flex justify-content-between">

                                                            <span>Comprar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>

                                                        </div>

                                                    </button>

                                                </form>

                                            <?php endif; ?>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



</body>



</html>



<?php require_once("../head/footer.php");?>

