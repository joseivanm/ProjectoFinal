<?php
require_once("../head/head.php");
require_once("../../controller/usuarioController.php");

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}

// Instancia de UsuarioController para manejar la lógica de los usuarios
$usuarioController = new UsuarioController();

// Obtener la lista de usuarios
$usuarios = $usuarioController->index();
?>






<div class="container-fluid">
    <h2>Controlar Usuarios</h2>
    <div class="col">
            <a class="btn btn-success mb-3" href="registroUsuario.php">Añadir Usuario</a>
        </div>
    <!-- Para dispositivos grandes (lg, xl) -->
    <div class="d-none d-lg-block">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['rol'] ?></td>
                            <td>
                                <!-- Añadir enlaces a las acciones que desees, por ejemplo, editar y ver detalles -->
                                <a href="editUsuario.php?id=<?= $usuario['id'] ?>" class="btn  btn-outline-dark">Editar</a>
                                <a href="showUsuario.php?id=<?= $usuario['id'] ?>" class="btn  btn-outline-dark">Detalles</a>
                                <!-- Asegúrate de que las URLs en tus enlaces estén correctamente formateadas -->
                                <a class="btn btn-danger" href="deleteUsuarios.php?id=<?= $usuario['id'] ?>">Eliminar</a>
                            </td>
                            <td>
                                <img src="<?= $usuario['imagen'] ?>" alt="Imagen de usuario" style="max-width: 50px;">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Para dispositivos pequeños (sm, md) -->
    <div class="d-block d-sm-block d-md-block d-lg-none">
        <?php foreach ($usuarios as $usuario): ?>
            <div class="row mb-3">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Correo:<?= $usuario['email'] ?></h6>
                            <h6 class="card-subtitle mb-2 text-muted">Rol:<?= $usuario['rol'] ?></h6>
                            <p class="card-text">ID: <?= $usuario['id'] ?></p>
                        </div>
                        <div class="card-body">
                            <img src="<?= $usuario['imagen'] ?>" class="img-fluid" alt="Imagen de usuario">
                        </div>
                        <div class="card-footer">
                            <a href="editUsuario.php?id=<?= $usuario['id'] ?>" class="btn btn-outline-dark">Editar</a>
                            <a href="showUsuario.php?id=<?= $usuario['id'] ?>" class="btn btn-outline-dark">Detalles</a>
                            <a href="deleteUsuarios.php?id=<?= $usuario['id'] ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rZo+SNREpB/QmCMyKtyDoF6tXizXJqcy9XxUZO8U3hhz2RKSixdY+84pLBE5t1y" crossorigin="anonymous"></script>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G6Z1Nj1z9z/HtlNzo4sF4JmCuFE8C2Jv8jVo" crossorigin="anonymous">


<footer class="bg-dark text-white py-4">
    
</footer>

 
</body>
</html>


