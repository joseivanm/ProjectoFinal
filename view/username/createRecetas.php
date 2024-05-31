<?php
require_once("../head/head.php");
?>
<div class="container-fluid">
    <h2>Añadir Receta</h2>
    <!-- Formulario para ingresar nuevos datos -->
    <form action="storeRecetas.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">
            <label for="titulo" class="form-label">Nombre</label>
            <input type="text" name="titulo" required class="form-control" id="titulo" aria-describedby="emailHelp">



            <!-- Añadir opción para cargar una imagen -->
            <label for="imagen" class="form-label">Cargar imagen</label>
            <input type="file" name="imagen" class="form-control" id="imagen" accept="image/*"> 


            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" required class="form-control" id="descripcion" rows="5"></textarea>

            <label for="descripcion" class="form-label">Elaboracion Minutos</label>
            <input type="number" name="tiempo" required class="form-control" id="tiempo" aria-describedby="tiempo">
        </div>

        <!-- Botones para guardar y cancelar -->
        <button type="submit" class="btn btn-outline-dark mt-auto">Guardar</button>
        <a class="btn btn-danger" href="lista_recetas.php">Cancelar</a>
</form>
</div>





