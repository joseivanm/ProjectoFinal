<?php
require_once("../head/head.php");
require_once("../../controller/usernameController.php");

// Crea una instancia del controlador
$obj = new usernameController();

// Obtiene los detalles del usuario basados en el id proporcionado a través de $_GET
$user = $obj->show($_GET['id']);
?>

<!-- Formulario para modificar un registro existente -->
<div class="container my-5">
    <form action="update.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <div>
            <h2>Modificando Registro</h2>
            <div class="mb-3 row">
                <label for="id" class="col-sm-2 col-form-label">id</label>
                <div class="col-sm-10">
                    <input type="text" name="id" readonly class="form-control-plaintext" id="id" value="<?= $user[0]?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nuevo nombre</label>
                <div class="col-sm-10">
                    <input type="text" name="nombre" class="form-control" id="nombre" value="<?= $user[1]?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="cantidad" class="col-sm-2 col-form-label">Nuevo cantidad</label>
                <div class="col-sm-10">
                    <input type="number" name="cantidad" class="form-control" id="cantidad" value="<?= $user[2]?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="precio" class="col-sm-2 col-form-label">Nuevo precio</label>
                <div class="col-sm-10">
                    <input type="text" name="precio" class="form-control" id="precio" value="<?= $user[3]?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="descripcion" class="col-sm-2 col-form-label">Nueva Descripción</label>
                <div class="col-sm-10">
                    <input type="text" name="descripcion" class="form-control" id="descripcion" value="<?= $user[8]?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="imagen" class="col-sm-2 col-form-label">Nueva imagen</label>
                <div class="col-sm-10">
                    <input type="file" name="imagen" class="form-control" id="imagen" accept="image/*" value="<?= $user[5]?>">
                </div>
            </div>
            <div>
                <!-- Botones para actualizar y cancelar -->
                <input type="submit" class="btn btn-success" value="Actualizar">
                <a class="btn btn-danger" href="lista_productos.php">Cancelar</a>
            </div>
        </div>
        <input type="hidden" name="disponible" id="disponible" value="0">
    </form>
</div>
<script>
    document.getElementById('cantidad').addEventListener('change', function() {
        var cantidad = parseInt(this.value);
        var disponible = cantidad > 0 ? 1 : 0;
        document.getElementById('disponible').value = disponible;
    });
</script>

