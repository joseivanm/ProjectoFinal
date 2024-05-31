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

// Inicializar variables
$nuevoEmail = $nuevoRol = $nuevoTelefono = $nuevoAlias = $nuevaPassword = '';
$error = '';

// Verificar si se envió un formulario para crear un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nuevoEmail = $_POST['email'];
    $nuevoTelefono = $_POST['telefono'];
    $nuevoAlias = $_POST['alias'];
    $nuevaPassword = $_POST['password'];

    // Validar los datos (puedes agregar más validaciones según tus necesidades)

    // Verificar si es administrador
    $nuevoRol = isset($_POST['adminCheckbox']) ? 'admin' : 'usuario';

    // Procesar la carga de la imagen
    $rutaImagen = '../../imagenesUsuario/';
    $nombreImagen = basename($_FILES['imagen']['name']);
    $rutaCompleta = $rutaImagen . $nombreImagen;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
        // La imagen se cargó correctamente, guardar el resto de los datos
        $resultado = $usuarioController->crearUsuario($nuevoEmail, $nuevoRol, $nuevoTelefono, $nuevoAlias, $nuevaPassword, $rutaCompleta);

        if ($resultado) {
            // Redirigir después de la creación exitosa
            header("Location: controlar_usuarios.php");
            exit();
        } else {
            $error = 'Error al crear el usuario. Por favor, verifica los datos.';
        }
    } else {
        $error = 'Error al cargar la imagen. Por favor, intenta nuevamente.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid">
    <h2>Crear Usuario</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data"> <!-- Añadir enctype para el manejo de archivos -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $nuevoEmail ?>" required>
        </div>
        <div class="mb-3">
    <label for="rol" class="form-label">Rol:</label>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="adminCheckbox" name="adminCheckbox">
        <label class="form-check-label" for="adminCheckbox">Administrador</label>
    </div>
</div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $nuevoTelefono ?>">
        </div>
        <div class="mb-3">
            <label for="alias" class="form-label">Alias:</label>
            <input type="text" class="form-control" id="alias" name="alias" value="<?= $nuevoAlias ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <!-- Agrega más campos según la información de tu usuario -->
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
        <a class="btn btn-danger" href="createUsuario.php">Añadir Usuario</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rZo+SNREpB/QmCMyKtyDoF6tXizXJqcy9XxUZO8U3hhz2RKSixdY+84pLBE5t1y" crossorigin="anonymous"></script>
</body>
</html>

<?php
require_once("../head/footer.php");
?>
