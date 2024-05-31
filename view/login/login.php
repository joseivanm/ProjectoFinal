<?php require_once("../head/head.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Iniciar Sesión</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        // Mostrar mensaje de error si existe
                        if (isset($_GET['error']) && $_GET['error'] == 1) {
                            echo "<p class='text-danger'>Credenciales incorrectas</p>";
                        }
                         elseif (isset($_GET['error']) && $_GET['error'] == 'usuario_desactivado') {
                        echo "<p class='text-danger'>El usuario se encuentra desactivado. Ponte en contacto con el administrador joseivan@gmail.com.</p>";
                        }
                        ?>

                        <form action="login_proces.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="recordar" class="form-check-input" id="recordar">
                                <label class="form-check-label" for="recordar">Recordar Contraseña</label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                <button type="button" class="btn btn-primary" onclick="location.href='../username/registroUsuario.php'">Registrarse</button>
                            </div>

                            <div class="text-center">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agrega el enlace al archivo JS de Bootstrap y Popper.js (si es necesario) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-8vjTcF3e2W1prQfDW7Un5yiFsg/gxpSQUFO2dgL4DOVNFbk9X3kqjV26OrhOQWPb" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si hay una cookie de inicio de sesión
            const cookieValue = getCookie("recordar");
            
            // Si hay una cookie de inicio de sesión, completar los campos de entrada
            if (cookieValue === "true") {
                const email = getCookie("email");
                const password = getCookie("password");
                document.querySelector("input[name='email']").value = email;
                document.querySelector("input[name='password']").value = password;
                document.querySelector("input[name='recordar']").checked = true;
            }
            
            // Manejar el evento cuando se envía el formulario
            document.querySelector("form").addEventListener("submit", function(event) {
                // Si la casilla de "Recordar Contraseña" está marcada, establecer cookies
                if (document.querySelector("input[name='recordar']").checked) {
                    const email = document.querySelector("input[name='email']").value;
                    const password = document.querySelector("input[name='password']").value;
                    setCookie("recordar", "true", 30); // Duración de la cookie: 30 días
                    setCookie("email", email, 30);
                    setCookie("password", password, 30);
                } else {
                    // Si la casilla no está marcada, eliminar las cookies
                    deleteCookie("recordar");
                    deleteCookie("email");
                    deleteCookie("password");
                }
            });

            // Función para establecer una cookie
            function setCookie(name, value, days) {
                const expires = new Date();
                expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
                document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
            }

            // Función para obtener el valor de una cookie
            function getCookie(name) {
                const cookieName = `${name}=`;
                const cookieArray = document.cookie.split(';');
                for (let i = 0; i < cookieArray.length; i++) {
                    let cookie = cookieArray[i];
                    while (cookie.charAt(0) === ' ') {
                        cookie = cookie.substring(1);
                    }
                    if (cookie.indexOf(cookieName) === 0) {
                        return cookie.substring(cookieName.length, cookie.length);
                    }
                }
                return "";
            }

            // Función para eliminar una cookie
            function deleteCookie(name) {
                document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;`;
            }
        });
    </script>

</body>
</html>



