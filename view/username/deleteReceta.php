<?php

//require_once("c://xampp/htdocs/proyecto/controller/usernameController.php");
require_once("../../controller/recetaController.php");

// Crea una instancia del controlador
$obj = new usernameController();

// Llama al método 'delete' del controlador, pasando la matrícula obtenida a través de $_GET
$obj->delete($_GET['id']);

?>

