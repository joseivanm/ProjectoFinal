<?php
require_once("../head/head.php");
require_once("../../controller/recetaController.php");

// Verificar si el usuario ha iniciado sesión y tiene el rol de administrador
if (!(isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin')) {
    header("Location: ../login/login.php"); // Redirigir a la página de inicio de sesión si no es administrador
    exit();
}

$obj = new usernameController(); // Cambiar a recetaController
$rows = $obj->index(); // Cambiar a recetaController
?>
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
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-black">
        <h1 class="display-4 fw-bolder">EDITAR RECETAS</h1>
    </div>
</div>

<div class="container text-center">
    <a href="createRecetas.php" class="btn btn-primary">Añadir Nueva Receta</a>
</div>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if ($rows): ?>
                <?php foreach ($rows as $row): ?>
                    <div class="col mb-5">
                        <div class="card h-100" style="background-color:  #FCF9EC;">
                            <?php if (!empty($row['imagen'])): ?>
                                <img class="card-img-top imagen-producto" src="imagenes/<?= $row['imagen'] ?>" alt="Imagen de la receta" />
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="text-center">
                                Nombre:<h5 class="fw-bolder"><?= $row[1] ?></h5>

                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="showReceta.php?id=<?= $row[0] ?>">Ver</a>
                                    <a href="editReceta.php?id=<?= $row[0] ?>" class="btn btn-outline-dark mt-auto">Editar</a>
                                    <button class="btn btn-danger mt-auto" onclick="openModal('deleteModal<?= $row[0] ?>')">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="deleteModal<?= $row[0] ?>" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('deleteModal<?= $row[0] ?>')">&times;</span>
                <p>¿Estás seguro de que quieres eliminar este producto?</p>
                <div>
                    <button class="btn btn-secondary" onclick="closeModal('deleteModal<?= $row[0] ?>')">Cancelar</button>
                    <a href="deleteReceta.php?id=<?= $row[0] ?>" class="btn btn-danger">Eliminar</a>
                </div>
                        </div>
                            </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <p class="center">No hay registros</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<script>
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "block";
        }
    
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }
        function reactivarProducto(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "block";

        }
    

    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G6Z1Nj1z9z/HtlNzo4sF4JmCuFE8C2Jv8jVo" crossorigin="anonymous">


<footer class="bg-dark text-white py-4">
    
</footer>

 
</body>
</html>