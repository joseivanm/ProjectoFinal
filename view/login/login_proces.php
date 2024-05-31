<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar credenciales
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Lógica de autenticación
require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/config/db.php");
$con = new db();
$pdo = $con->conexion();

$statement = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
$statement->bindParam(":email", $email);
$statement->execute();
$user = $statement->fetch();

if ($user) {
        // Verificar el estado del usuario
        if ($user['estado'] === 'eliminado') {
            // Usuario desactivado
            header("Location: login.php?error=usuario_desactivado");
            exit();
        }
    // Credenciales válidas, verificar el rol y la contraseña
    if (password_verify($password, $user['password'])) {
        // Incluyendo más detalles del usuario en la variable de sesión

        $_SESSION['usuario'] = [
            'email' => $email,
            'rol' => $user['rol'],
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'apellido1' => $user['apellido1'],
            'apellido2' => $user['apellido2'],
            'direccion' => $user['direccion'],
            'codigoPostal' => $user['codigoPostal'],
            'poblacion' => $user['poblacion'],
            'provincia' => $user['provincia'],
            'name' => $user['alias'],
            'imagen' => $user['imagen']
        ];

        if ($user['rol'] === 'admin') {
            header("Location: ../username/index.php");
            exit();
        } else {
            header("Location: ../username/index.php");
            exit();
        }
    } else {
        // Contraseña incorrecta, redirigir o mostrar mensaje de error
        header("Location: login.php?error=1");
        exit();
    }
} else {
    // Credenciales incorrectas, redirigir o mostrar mensaje de error
    header("Location: login.php?error=1");
    exit();
}
?>
