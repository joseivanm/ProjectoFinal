<?php
require_once("../head/head.php");
?>
<div class="container-fluid">
<h2>Añadir Producto</h2>
    <!-- Formulario para ingresar nuevos datos -->
    <form action="store.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" required class="form-control" id="nombre" aria-describedby="emailHelp" required>

            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" required class="form-control" id="cantidad" aria-describedby="emailHelp" required>

            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" required class="form-control" id="precio" aria-describedby="emailHelp" required>

            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" name="descripcion" required class="form-control" id="descripcion" aria-describedby="emailHelp" required>

            <!-- Añadir opción para cargar una imagen -->
            <label for="imagen" class="form-label">Cargar imagen</label>
            <input type="file" name="imagen" class="form-control" id="imagen" accept="image/*" required> 
        </div>

        <!-- Botones para guardar y cancelar -->
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="index.php">Cancelar</a>
    </form>
</div>

<?php
require_once("../head/footer.php");
?>



