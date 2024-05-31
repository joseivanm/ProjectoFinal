<?php
require_once("../head/head.php");
require_once("../../controller/recetaController.php");

$obj = new usernameController();
$rows = $obj->index();
?>
<style>
    .imagen-producto {
        max-width: 100%;
        height: 200px; /* Ajusta la altura deseada */
        object-fit: cover; /* Mantiene la proporción y corta si es necesario */
    }
</style>

<div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-black">
        <h1 class="display-4 fw-bolder">RECETAS</h1>
        <p class="lead fw-normal text-black-50 mb-0">Prepara tus recetas</p>
    </div>
</div>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if ($rows): ?>
                <?php foreach ($rows as $row): ?>
                    <div class="col mb-5">
                        <div class="card h-100"style="background-color:  #FCF9EC;">
                            <?php if (!empty($row['imagen'])): ?>
                                <img class="card-img-top imagen-producto" src="imagenes/<?= $row['imagen'] ?>" alt="Imagen del producto" />
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h4 class="fw-bolder"><?= $row[1] ?></h4>
                                    <p>Tiempo Elaboración:</p>
                                    <p> <?= $row[6] ?> minutos</p>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="showReceta.php?id=<?= $row[0] ?>">Ver</a>
                                </div>
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

<?php
require_once("../head/footer.php");
?>
