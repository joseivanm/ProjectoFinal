<?php
require_once("../head/head.php");
require_once("../../controller/recetaController.php");

// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
/*if (!(isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin')) {
    header("Location: ../login/login.php"); // Redirigir a la página de inicio de sesión si no es administrador
    exit();
}*/

// Verificar si se proporciona un ID de receta válido en la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php"); // Redirigir a la página de visualización de todas las recetas si no se proporciona un ID válido
    exit();
}

// Obtener el ID de la receta de la URL
$receta_id = $_GET['id'];

// Crear una instancia del controlador de recetas
$recetaController = new usernameController();

// Obtener los detalles de la receta utilizando el método de búsqueda por ID del controlador de recetas
$receta = $recetaController->show($receta_id);

// Verificar si se encontró la receta
if (!$receta) {
    header("Location: index.php"); // Redirigir a la página de visualización de todas las recetas si la receta no se encuentra
    exit();
}
?>


<div class="container">
    <h2 class="text-center mt-4 mb-3">DETALLES DE LA RECETA</h2>

    <div class="row">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <img class="img-fluid rounded" src="imagenes/<?= $receta['imagen'] ?>" alt="Imagen de la receta">
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Titulo:</th>
                        <td><?= $receta['titulo'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tiempo de Preparacion:</th>
                        <td><?= $receta['Tiempo'] ?> minutos</td>
                    </tr>
                    <tr>

                        <th scope="row">Fecha Creado:</th>
                        <td><?= $receta['fecha_carga'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-left">
                <br>
                <h2>Elaboración</h2>
                <p class="card-text"><?= nl2br($receta['descripcion']) ?></p>
                <!-- Enlace para volver -->
                <a href="recetas.php" class="btn btn-outline-dark mt-auto ">Volver</a>
            </div>
        </div>
    </div>
</div>


<?php
require_once("../head/footer.php");
/*
<div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-black">
        <h1 class="display-4 fw-bolder">DETALLES DE LA RECETA</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid rounded" src="imagenes/<?= $receta['imagen'] ?>" alt="Imagen de la receta">
        </div>
        <div class="col-md-6">

            <h5 class="card-title">Titulo: <?= $receta['titulo'] ?></h5>
            <p class="card-text">Tiempo Preparacion: <?= $receta['Tiempo'] ?>Horas</p>
            <p class="card-text">Creada: <?= $receta['fecha_carga'] ?></p>
        </div>
        <p class="card-text"><?= $receta['descripcion'] ?></p>
        <!-- Botón de volver -->
    </div>
    <a href="index.php" class="btn btn-primary mt-auto">Volver</a>
</div>
///////
*/
?>
