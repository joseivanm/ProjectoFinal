<style>
    /* Animación de entrada */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fadeIn {
        animation: fadeIn 0.5s ease-in-out;
    }
</style>
<?php
require_once("../head/head.php");
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    
    // Aquí puedes hacer cualquier otra validación o procesamiento de los datos si es necesario

    // Mostrar el mensaje de confirmación

    
}
?>
<div class="container mt-5">
    <div class="alert alert-success text-center fadeIn" role="alert">
        <h4 class="alert-heading">¡Mensaje Enviado!</h4>
        <p>Redireccionando a la página de inicio en <span id="countdown">3</span> segundos...</p>
    </div>
</div>


<!-- Bootstrap JS and custom script -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        // Contador de tiempo para redireccionar
        let timeLeft = 3;
        let countdown = document.getElementById('countdown');
        let timer = setInterval(() => {
            timeLeft--;
            countdown.textContent = timeLeft;
            if (timeLeft === 0) {
                clearInterval(timer);
                window.location.href = 'index.php'; // Cambiar a la URL de tu página de inicio
            }
        }, 1000);
    </script>







</body>

</html>