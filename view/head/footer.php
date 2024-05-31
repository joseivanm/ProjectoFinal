</div>
<div id="cookie-banner" style="display: none; position: fixed; bottom: 0; left: 0; width: 100%; background-color: rgba(0, 0, 0, 0.8); color: #fff; padding: 10px; text-align: center; z-index: 9999;">
    <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario.</p>
    <button class="btn btn-light" style="cursor: pointer; border-radius: 5px;" onclick="aceptarCookies()">Aceptar</button>
</div>

<script>
    // Función para aceptar las cookies y ocultar el banner
    function aceptarCookies() {
        document.cookie = "cookies_aceptadas=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        document.getElementById("cookie-banner").style.display = "none";
    }

    // Comprobar si las cookies ya han sido aceptadas
    function cookiesAceptadas() {
        return document.cookie.split(';').some((item) => item.trim().startsWith('cookies_aceptadas='));
    }

    // Mostrar el banner de cookies si aún no han sido aceptadas
    if (!cookiesAceptadas()) {
        document.getElementById("cookie-banner").style.display = "block";
    }
</script>
<!-- Incluye los archivos de JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G6Z1Nj1z9z/HtlNzo4sF4JmCuFE8C2Jv8jVo" crossorigin="anonymous">
<style>
    .info-links p {
        margin-bottom: 5px; /* Agrega espacio entre los párrafos */
        font-size: 16px; /* Ajusta el tamaño del texto */
    }

</style>
<br>
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <h3>Contactanos</h3>
                <p>Dirección: Calle Estrella nº1<br>
                    Código Postal: 033113<br>
                    Población: Alicante<br>
                    Provincia: Alicante</p>
            </div>
            <div class="col-md-4 text-center">
                <h3>Síguenos</h3>
                <a href="#"><i class="bi bi-instagram text-white" style="font-size: 2em;"></i></a>
                <a href="#"><i class="bi bi-facebook text-white" style="font-size: 2em;"></i></a>
                <a href="#"><i class="bi bi-twitter-x text-white" style="font-size: 2em;"></i></a>
            </div>

            <div class="col-md-4 text-center info-links">
                 <h3>Información</h3>
                <p><a href="politica_de_privacidad.php" class="text-decoration-none text-white">>Política de privacidad</a></p>
                <p><a href="aviso_legal.php" class="text-decoration-none text-white">>Aviso legal</a></p>
                <p><a href="politica_cookies.php" class="text-decoration-none text-white">>Política de cookies</a></p>
                </div>
        </div>
    </div>
</footer>

 
</body>
</html>