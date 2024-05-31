<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: white;
            padding-top: 56px; /* Ajuste para el menú fixed-top */
        }
        .text-white {
            color: white !important;
        }
        .dropdown-menu {
            background-color: black; /* Fondo negro para el submenú */
            color: white; /* Texto en blanco */
        }
        .dropdown-menu a:hover {
            background-color: #212529; /* Color gris oscuro al pasar el ratón */
            color: white; /* Mantener el texto blanco al pasar el ratón */
        }

        /* Agrega tus estilos personalizados aquí si es necesario */
                .btn-ver-detalles {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-ver-detalles:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #fff;
        }
        .icono-menu-burger {
        color: green !important;
        }
    </style>
</head>
<body>
<script src="../../javascrip/contadorCarrito.js"></script>
<script src="../../javascrip/verCarrito.js"></script>
<script src="../../javascrip/addCarrito.js"></script>
<script src="../../javascrip/sumarCarrito.js"></script>
<script src="../../javascrip/restarCarrito.js"></script>
<script src="../../javascrip/calcularTotal.js"></script>
<script src="../../javascrip/modificarCantidad.js"></script>
<script src="../../javascrip/cambiarEstado.js"></script>
<script src="../../javascrip/rotacionImagenes.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
<div class="container px-4 px-lg-5">
    <a class="navbar-brand text-white" href="../username/index.php">Inicio</a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="bi bi-justify " style="color: white;"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link text-white" href="../username/recetas.php">Recetas</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="../username/quienesSomos.php">Quienes somos</a></li>
        </ul>
        <form class="d-none d-md-block"> <!-- Ocultar en dispositivos medianos y pequeños -->
            <?php
            if (session_status() === PHP_SESSION_NONE) { session_start(); }
            //comprobar que se ha iniciado sesión para mostrar el botón de carrito
            if (isset($_SESSION['usuario'])) {
                echo '<button class="btn btn-outline-dark text-white" type="button" id="btnVerCarrito">';
                echo '<i class="bi bi-cart-fill"></i>'; // Ícono de carrito
                echo '<span id="cart-badge" class="badge bg-dark text-white ms-1 rounded-pill"></span>';
                echo '</button>';
            }
            ?>
        </form>
        <div class="d-md-none d-lg-inline-flex"> <!-- Agregar clases Bootstrap para mostrar en dispositivos grandes -->
            <?php
            if (session_status() === PHP_SESSION_NONE) { session_start(); }

            if (isset($_SESSION['usuario'])) {
                //si se ha iniciado sesion cambia el boton de iniciar sesion por el nombre de usuario y sale un menu desplegable
                echo '<div class="dropdown">';
                echo '<button class="btn btn-outline-dark dropdown-toggle" style="color: white !important;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION['usuario']['name'] . '</button>';
                echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">';
                
                if ($_SESSION['usuario']['rol'] === 'admin') {//si es admin muestra un menu de opciones
                    echo '<li><a class="dropdown-item text-white" href="../username/controlar_usuarios.php">Controlar Usuarios</a></li>';
                    echo '<li><a class="dropdown-item text-white" href="../username/lista_productos.php">Ver Lista de Productos</a></li>';
                    echo '<li><a class="dropdown-item text-white" href="../username/lista_recetas.php">Ver Lista de Recetas</a></li>';
                    echo '<li><a class="dropdown-item text-white" href="../username/pedidosGlobal.php">PEDIDOS</a></li>';
                }
                //muestra el resto de opcion tanto si es admin o usuario
                echo '<li><a class="dropdown-item text-white" href="../username/perfil.php">Ver Perfil</a></li>';
                echo '<li><a class="dropdown-item text-white" href="../username/pedidos.php">Mis Pedidos</a></li>';
                echo '<li><a class="dropdown-item text-white" href="../login/logout.php">Cerrar Sesión</a></li>';
                
                echo '</ul>';
                echo '</div>';
            } else {
                echo '<a class="btn btn-outline-dark text-white" href="../login/login.php">Iniciar Sesión</a>';
            }
            ?>
        </div>


    </div>
</div>

</nav>


