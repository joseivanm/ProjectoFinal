<?php
session_start();

// Cerrar la sesión
session_unset();
session_destroy();

// Redirigir a la página de login
header("Location: ../username/index.php");
exit();
?>
