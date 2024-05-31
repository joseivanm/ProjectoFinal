<?php
require_once("../head/head.php");
require_once("../../controller/usuarioController.php");

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}

// Verificar si se proporciona un ID de usuario en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: controlar_usuarios.php");
    exit();
}

// Obtener el ID de usuario de la URL
$idUsuario = $_GET['id'];

// Instancia de UsuarioController para manejar la lógica de los usuarios
$usuarioController = new UsuarioController();

// Obtener la información del usuario
$usuario = $usuarioController->obtenerUsuarioPorId($idUsuario);


// Verificar si el usuario existe
if (!$usuario) {
    header("Location: controlar_usuarios.php");
    exit();
}

?>


    <style>
        .container-fluid {
            position: relative;
        }

        .user-image {
            max-width: 100px; /* Ajusta el tamaño según tus necesidades */
            max-height: 100px; /* Ajusta el tamaño según tus necesidades */
        }
    </style>


<div class="container-fluid">
    <h2>Detalles del Usuario <?= $usuario['alias'] ?></h2>
    <img src="<?= $usuario['imagen'] ?>" alt="Imagen de usuario" class="user-image">
    <table class="table">
        <tbody>
            <tr>
                <th>ID:</th>
                <td><?= $usuario['id'] ?></td>
            </tr>
            <tr>
                <th>Rol:</th>
                <td><?= $usuario['rol'] ?></td>
            </tr>
            <tr>
                <th>Alias:</th>
                <td><?= $usuario['alias'] ?></td>
            </tr>
                <th>Nombre:</th>
                <td><?= $usuario['nombre']?></td>
            </tr>
                <th>Primer apellido:</th>
                <td><?= $usuario['apellido1'] ?></td>
            </tr>
                <th>Segundo apellido :</th>
                <td><?= $usuario['apellido2'] ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?= $usuario['email'] ?></td>
            </tr>
            <tr>
                <th>Dirección:</th>
                <td><?= $usuario['direccion'] ?></td>
            </tr>
            <tr>
                <th>Poblacion:</th>
                <td><?= $usuario['poblacion'] ?></td>
            </tr>
            <tr>
                <th>Provincia:</th>
                <td><?= $usuario['provincia'] ?></td>
            </tr>
            <tr>
                <th>Codigo postal:</th>
                <td><?= $usuario['codigoPostal'] ?></td>
            </tr>
            <!-- Agrega más filas según la información de tu usuario -->
        </tbody>
    </table>
    <a href="controlar_usuarios.php" class="btn btn-success">Volver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rZo+SNREpB/QmCMyKtyDoF6tXizXJqcy9XxUZO8U3hhz2RKSixdY+84pLBE5t1y" crossorigin="anonymous"></script>
</body>
</html>


