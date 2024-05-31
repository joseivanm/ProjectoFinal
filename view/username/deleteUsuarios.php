<?php
require_once("../../controller/usuarioController.php");

// Crea una instancia del controlador
$usuarioController = new UsuarioController();

// Verifica si se proporciona un ID a través de $_GET
if (isset($_GET['id'])) {
    // Obtén el ID
    $id = $_GET['id'];

    // Llama al método 'delete' del controlador, pasando el ID
    $usuarioController->delete($id);

    // Redirige a la página de controlar_usuarios.php después de eliminar
    header("Location: controlar_usuarios.php");
    exit();
} else {
    // Maneja la situación donde no se proporciona un ID
    echo "Error: ID no proporcionado";
}
?>
