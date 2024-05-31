<?php
ob_start(); // Iniciar el buffer de salida

require_once("../head/head.php");
require_once("../../controller/usuarioController.php");

// Verificar si el usuario tiene permisos de administrador
$rol = isset($_SESSION['usuario']['rol']) ? $_SESSION['usuario']['rol'] : '';


// Instancia de UsuarioController para manejar la lógica de los usuarios
$usuarioController = new UsuarioController();

// Inicializar variables
$nuevoNombre = $nuevoPrimerApellido = $nuevoSegundoApellido = $nuevoEmail = $nuevoTelefono = $nuevoAlias = $nuevaPassword = $nuevaDireccion = $nuevoCodigoPostal = $nuevaPoblacion = $nuevaProvincia = '';
$error = '';

// Verificar si se envió un formulario para crear un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $nuevoNombre = $_POST['nombre'];
    $nuevoPrimerApellido = $_POST['primer_apellido'];
    $nuevoSegundoApellido = $_POST['segundo_apellido'];
    $nuevoEmail = $_POST['email'];
    $nuevoTelefono = $_POST['telefono'];
    $nuevoAlias = $_POST['alias'];
    $nuevaPassword = $_POST['password'];
    $nuevaDireccion = $_POST['direccion'];
    $nuevoCodigoPostal = $_POST['codigo_postal'];
    $nuevaPoblacion = $_POST['poblacion'];
    $nuevaProvincia = $_POST['provincia'];

    // Validar los datos
    if (!filter_var($nuevoEmail, FILTER_VALIDATE_EMAIL)) {
        $error = 'El email proporcionado no es válido.';
    } elseif ($usuarioController->existeEmail($nuevoEmail)) {
        $error = 'El email ya está registrado en la base de datos.';
    } elseif ($usuarioController->existeAlias($nuevoAlias)) {
        $error = 'El alias ya está en uso. Por favor, elige otro.';
    } elseif ($usuarioController->existeTelefono($nuevoTelefono)) {
        $error = 'El número de teléfono ya está registrado en la base de datos.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $error = 'Las contraseñas no coinciden. Por favor, verifícalas.';
    } else {
        // Procesar la carga de la imagen
        $rutaImagen = '../../imagenesUsuario/';
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaCompleta = $rutaImagen . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
            // La imagen se cargó correctamente, guardar el resto de los datos
            $nuevoRol = isset($_POST['adminCheckbox']) ? 'admin' : 'usuario';
            $resultado = $usuarioController->crearUsuario(
                $nuevoNombre,
                $nuevoPrimerApellido,
                $nuevoSegundoApellido,
                $nuevoEmail,
                $nuevoTelefono,
                $nuevoAlias,
                $nuevaPassword,
                $nuevaDireccion,
                $nuevoCodigoPostal,
                $nuevaPoblacion,
                $nuevaProvincia,
                $rutaCompleta,
                $nuevoRol
            );

            // Redirigir después de la creación exitosa
            header("Location: index.php");
            ob_end_flush(); // Limpiar el buffer de salida y enviar la salida
            exit();
        } else {
            $error = 'Error al cargar la imagen. Por favor, intenta nuevamente.';
        }
    }
}
?>


<style>
        .invalid-email {
        border-color: #dc3545 !important; /* Cambia el color del borde a rojo */
    }
</style>
<body>

<div class="container-fluid">
    <h2>Crear Usuario</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data"> <!-- Añadir enctype para el manejo de archivos -->
        <div class="row">
        <?php if ($rol === 'admin'): ?>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="adminCheckbox" name="adminCheckbox">
                    <label class="form-check-label" for="adminCheckbox">Administrador</label>
                </div>
            </div>
        <?php endif; ?>
            <!-- Resto de los campos -->
            <p>* Campo Obligatorio</p>
            <div class="col-md-6">
                <!-- Otros campos -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:*</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nuevoNombre ?>" required>
                </div>
                <div class="mb-3">
                    <label for="primer_apellido" class="form-label">Primer Apellido:*</label>
                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?= $nuevoPrimerApellido ?>" required>
                </div>
                <div class="mb-3">
                    <label for="segundo_apellido" class="form-label">Segundo Apellido:*</label>
                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?= $nuevoSegundoApellido ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" id="emailLabel">Email:*</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $nuevoEmail ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:*</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $nuevoTelefono ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:*</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="alias" class="form-label">Alias:*</label>
                    <input type="text" class="form-control" id="alias" name="alias" value="<?= $nuevoAlias ?>" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:*</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $nuevaDireccion ?>" required>
                </div>
                <div class="mb-3">
                    <label for="codigo_postal" class="form-label">Código Postal:*</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?= $nuevoCodigoPostal ?>" required>
                </div>
                <div class="mb-3">
                    <label for="poblacion" class="form-label">Población:*</label>
                    <input type="text" class="form-control" id="poblacion" name="poblacion" value="<?= $nuevaPoblacion ?>">
                </div>
                <div class="mb-3">
                    <label for="provincia" class="form-label">Provincia:*</label>
                    <input type="text" class="form-control" id="provincia" name="provincia" value="<?= $nuevaProvincia ?>" required>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmar Contraseña:*</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:*</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <div class="mb-3">
        <!-- Agrega más campos según la información de tu usuario -->
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </div>
    </form>
</div>

<script>
    // Verificar si las contraseñas coinciden antes de enviar el formulario
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function(event) {
            const password = document.getElementById("password").value;
            const confirm_password = document.getElementById("confirm_password").value;

            if (password !== confirm_password) {
                event.preventDefault(); // Evitar que se envíe el formulario
                alert("Las contraseñas no coinciden. Por favor, verifícalas.");
            }
        });
    });

    // Validar el formato del correo electrónico
    function validarEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("email").addEventListener("change", function() {
            const emailInput = this;
            const emailValue = emailInput.value.trim(); // Eliminar espacios en blanco al inicio y al final
            const emailLabel = document.getElementById("emailLabel");


            // Verificar si el campo de correo electrónico no está vacío antes de realizar la validación
            if (emailValue !== "" && !validarEmail(emailValue)) {
                // Mostrar el mensaje de error si el correo es incorrecto
                emailLabel.textContent = "Email Incorrecto";
                emailLabel.style.color = "red";
                emailInput.value = "";
                
            } else {
                // Quitar el mensaje de error si el correo es válido
                emailLabel.textContent = "Email:*";
                emailLabel.style.color = "";
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rZo+SNREpB/QmCMyKtyDoF6tXizXJqcy9XxUZO8U3hhz2RKSixdY+84pLBE5t1y" crossorigin="anonymous"></script>
</body>
</html>

<?php
require_once("../head/footer.php");
?>
