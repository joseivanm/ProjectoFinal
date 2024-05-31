<?php
require_once("../head/head.php");
?>
    <style>
        .custom-bg {
            background-color: #FCF9EC !important;
        }
    </style>

<div class="container mt-4 bg-light py-4 rounded border custom-bg">
    <h2 class="mb-4">Encuéntranos</h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5417.444001354984!2d-0.5848392798309734!3d38.33673130457799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd623514f2b1f6bf%3A0xf74536cbcea8194d!2sHIJOS%20DE%20FEDERICO%20LIS%20S.A.!5e0!3m2!1ses!2ses!4v1715253397536!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<div class="container mt-4 bg-light py-4 rounded border custom-bg">
    <h2 class="mb-4">Contáctanos</h2>
    <form action="FormularioContacto.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-outline-dark">Enviar</button>
    </form>
</div>

<div class="container mt-4 bg-light py-4 rounded border custom-bg">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Quiénes somos</h1>
            <p>Somos una empresa dedicada a la venta de verduras ecológicas cultivadas con los más altos estándares de calidad y respeto por el medio ambiente. Nuestro objetivo es proporcionar productos frescos y saludables a nuestros clientes, promoviendo así un estilo de vida consciente y sostenible.</p>
            <p>En nuestra finca ecológica, cultivamos una amplia variedad de verduras sin el uso de pesticidas ni fertilizantes químicos. Nos comprometemos a ofrecer productos frescos, sabrosos y nutritivos que contribuyan al bienestar de nuestros clientes y al cuidado del planeta.</p>
            <p>Además, trabajamos en estrecha colaboración con agricultores locales que comparten nuestra visión de la agricultura sostenible, promoviendo así el desarrollo económico y social de nuestra comunidad.</p>
        </div>
        <div class="col-md-4">
            <img src="../../imagenes/jjj.jpg" class="img-fluid" alt="Imagen Quiénes somos">
        </div>
    </div>
</div>

<?php require_once("../head/footer.php"); ?>
</body>
</html>