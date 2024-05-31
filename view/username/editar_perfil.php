<?php
// Iniciar el buffer de salida
ob_start();

require_once("../head/head.php");
require_once("../../controller/usuarioController.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    ob_end_flush(); // Limpiar el buffer de salida y enviar la salida
    exit();
}

// Obtener el ID del usuario logueado
$idUsuarioLogueado = $_SESSION['usuario']['id'];

// Verificar si el usuario tiene permisos de administrador
$esAdmin = ($_SESSION['usuario']['rol'] === 'admin');

// Verificar si se proporciona un ID de usuario en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Si no se proporciona un ID en la URL, redirigir a controlar_usuarios.php
    header("Location: controlar_usuarios.php");
    ob_end_flush(); // Limpiar el buffer de salida y enviar la salida
    exit();
}

// Obtener el ID de usuario de la URL
$idUsuario = $_GET['id'];

// Verificar si el usuario es un administrador o si está editando su propio perfil
if (!$esAdmin && $idUsuario != $idUsuarioLogueado) {
    // Si el usuario no es administrador y no está editando su propio perfil, redirigir a controlar_usuarios.php
    header("Location: controlar_usuarios.php");
    ob_end_flush(); // Limpiar el buffer de salida y enviar la salida
    exit();
}

// Instancia de UsuarioController para manejar la lógica de los usuarios
$usuarioController = new UsuarioController();

// Obtener la información del usuario
$usuario = $usuarioController->obtenerUsuarioPorId($idUsuario);

// Verificar si el usuario existe
if (!$usuario) {
    header("Location: controlar_usuarios.php");
    ob_end_flush(); // Limpiar el buffer de salida y enviar la salida
    exit();
}

// Ruta donde se guardarán las imágenes
$rutaImagenes = '../../imagenesUsuario/';

// Verificar si se envió un formulario para actualizar la información del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nuevoEmail = $_POST['email'];
    $nuevoTelefono = $_POST['telefono'];
    $nuevoAlias = $_POST['alias'];
    $nuevoNombre = $_POST['nombre'];
    $nuevoApellido1 = $_POST['apellido1'];
    $nuevoApellido2 = $_POST['apellido2'];
    $nuevaDireccion = $_POST['direccion'];
    $nuevaPoblacion = $_POST['poblacion'];
    $nuevaProvincia = $_POST['provincia'];
    $nuevoCodigoPostal = $_POST['codigo_postal'];
    $nuevoRol = isset($_POST['admin']) && $_POST['admin'] === 'admin' ? 'admin' : 'usuario'; // Si el checkbox está marcado, el rol será 'admin', de lo contrario, 'usuario'
    $nuevaPassword = $_POST['password'];
   // Verificar la nueva contraseña
    $nuevaPassword = !empty($_POST['password']) ? $_POST['password'] : null;
    // Procesar la imagen
    $nuevaImagen = $usuario['imagen']; // Mantener la imagen actual como predeterminada

    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Si se subió una nueva imagen, procesarla
        $rutaTempImagen = $_FILES['imagen']['tmp_name'];
        $nombreImagen = $_FILES['imagen']['name'];
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        $nombreImagenPersonalizado = $nombreImagen; // Puedes usar el nombre original o personalizarlo según tus necesidades
        $nuevaImagen = $rutaImagenes . $nombreImagenPersonalizado; // Ruta completa de la imagen

        // Mueve el archivo a la ubicación deseada
        move_uploaded_file($rutaTempImagen, $nuevaImagen);
    }

    // Actualizar la información del usuario
    $usuarioController->actualizarUsuario(
        $idUsuario,
        $nuevoNombre,
        $nuevoApellido1,
        $nuevoApellido2,
        $nuevoEmail,
        $nuevoTelefono,
        $nuevoAlias,
        $nuevaPassword,
        $nuevaDireccion,
        $nuevoCodigoPostal,
        $nuevaPoblacion,
        $nuevaProvincia,
        $nuevaImagen,
        $nuevoRol
    );

    ob_end_flush(); // Limpiar el buffer de salida y enviar la salida

    header("Location: controlar_usuarios.php"); // Redireccionar después de actualizar el usuario
    exit();
}
?>


<div class="container-fluid">
    <h2>Editar Usuario</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" required>
        </div>
        <?php if ($esAdmin): ?> <!-- Mostrar checkbox de rol solo si es admin -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="admin" name="admin" value="admin" <?= $usuario['rol'] === 'admin' ? 'checked' : '' ?>>
                <label class="form-check-label" for="admin">Admin</label>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $usuario['telefono'] ?>">
        </div>
        <div class="mb-3">
        <label for="alias" class="form-label">Alias:</label>
            <input type="text" class="form-control" id="alias" name="alias" value="<?= $usuario['alias'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>">
        </div>
        <div class="mb-3">
            <label for="apellido1" class="form-label">Apellido 1:</label>
            <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?= $usuario['apellido1'] ?>">
        </div>
        <div class="mb-3">
            <label for="apellido2" class="form-label">Apellido 2:</label>
            <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?= $usuario['apellido2'] ?>">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $usuario['direccion'] ?>">
        </div>
        <div class="mb-3">
            <label for="poblacion" class="form-label">Población:</label>
            <input type="text" class="form-control" id="poblacion" name="poblacion" value="<?= $usuario['poblacion'] ?>">
        </div>
        <div class="mb-3">
            <label for="provincia" class="form-label">Provincia:</label>
            <input type="text" class="form-control" id="provincia" name="provincia" value="<?= $usuario['provincia'] ?>">
        </div>
        <div class="mb-3">
            <label for="codigo_postal" class="form-label">Código Postal:</label>
            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?= $usuario['codigoPostal'] ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/*">
        </div>
        
        <!-- Agrega más campos según la información de tu usuario -->
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rZo+SNREpB/QmCMyKtyDoF6tXizXJqcy9XxUZO8U3hhz2RKSixdY+84pLBE5t1y" crossorigin="anonymous"></script>
</body>
</html>

<?php
require_once("../head/footer.php");
// Finalizar el buffer de salida
ob_end_flush();
?>