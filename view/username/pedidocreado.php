<<?php require_once("../head/head.php");?>

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


    <div class="container mt-5">
        <div class="alert alert-success text-center fadeIn" role="alert">
            <h4 class="alert-heading">¡Pedido Creado Correctamente!</h4>
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

