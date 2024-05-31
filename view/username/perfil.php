<?php
require_once("../head/head.php");
require_once("../../controller/usuarioController.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: ../login/login.php");
    exit();
}
// Instancia de UsuarioController para manejar la lógica de los usuarios
$usuarioController = new UsuarioController();

$idUsuarioLogueado = $_SESSION['usuario']['id'];

$usuario = $usuarioController->obtenerUsuarioPorId($idUsuarioLogueado);
?>

<div class="container">
    <h2>Perfil de Usuario</h2>

    <?php if (!empty($usuario['imagen'])): ?>

        <img src="<?= $usuario['imagen'] ?>" alt="Imagen de usuario" style="max-width: 200px;">
    <?php else: ?>
        <p>No hay imagen de perfil</p>
    <?php endif; ?>

    <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
    <p><strong>Rol:</strong> <?php echo $usuario['rol']; ?></p>
    <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
    <p><strong>Apellido 1:</strong> <?php echo $usuario['apellido1']; ?></p>
    <p><strong>Apellido 2:</strong> <?php echo $usuario['apellido2']; ?></p>
    <p><strong>Dirección:</strong> <?php echo $usuario['direccion']; ?></p>
    <p><strong>Población:</strong> <?php echo $usuario['poblacion']; ?></p>
    <p><strong>Provincia:</strong> <?php echo $usuario['provincia']; ?></p>
    <p><strong>Código Postal:</strong> <?php echo $usuario['codigoPostal']; ?></p>
    <!-- Agrega más campos según la información del usuario -->


    <a href="editar_perfil.php?id=<?php echo $usuario['id']; ?>" class="btn btn-primary">Editar Perfil</a>

</div>

<?php
require_once("../head/footer.php");
?>
