<?php
require_once("../head/head.php");
require_once("../../controller/recetaController.php");

// Crea una instancia del controlador
$obj = new usernameController();

// Obtiene los detalles del usuario basados en el id proporcionado a través de $_GET
$user = $obj->show($_GET['id']);
?>
<div class="container">
<!-- Formulario para modificar un registro existente -->
<form action="updateReceta.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <!-- Añadido el atributo enctype para permitir la carga de archivos -->
    <h2>Modificando Receta</h2>
    <div class="mb-3">
        
    <div class="mb-3 row">
        <label for="id" class="col-sm-2 col-form-label">id producto</label>
        <div class="col-sm-10">
            <!-- Campo de matrícula readonly con el valor obtenido del usuario -->
            <input type="text" name="id" readonly class="form-control-plaintext" id="id" value="<?= $user[0]?>">
        </div>
    </div>
        
        <label for="titulo" class="form-label">Nuevo nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="<?= $user[1]?>">
        
            <!-- Añadir opción para cargar una imagen -->
            <label for="imagen" class="form-label">Nueva imagen</label>
            <input type="file" name="imagen" class="form-control" id="imagen" accept="image/*" accept="image/*" value="<?= $user[5]?>"> 


            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" required class="form-control" id="descripcion" rows="5"><?= $user[3]?></textarea>

            <label for="descripcion" class="form-label">Elaboracion Minutos</label>
            <input type="number" name="tiempo" required class="form-control" id="tiempo" aria-describedby="tiempo"  value="<?= $user[6]?>">
    </div>

 



        <!-- Botones para actualizar y cancelar -->
        <input type="submit" class="btn btn-outline-dark mt-auto" value="Actualizar">
        <a class="btn btn-danger" href="lista_recetas.php">Cancelar</a>
    </div>
</form>
</div>




