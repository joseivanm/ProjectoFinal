<?php
require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/controller/usernameController.php");

// Crea una instancia del controlador
$obj = new usernameController();

// Verifica si el formulario se ha enviado y si se ha cargado una imagen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : null;
    $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : null;

    // Verifica si se ha cargado una imagen
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
        // Obtener la información del archivo
        $archivoNombre = $_FILES["imagen"]["name"];
        $archivoTmp = $_FILES["imagen"]["tmp_name"];

        // Ruta del directorio de imágenes en la raíz del proyecto
        $directorioImagenes = __DIR__ . "/imagenes/";

        // Asegurarse de que el directorio exista o créalo si no existe
        if (!file_exists($directorioImagenes)) {
            mkdir($directorioImagenes, 0777, true);
        }

        // Mueve el archivo al directorio de imágenes
        move_uploaded_file($archivoTmp, $directorioImagenes . $archivoNombre);

        // Llama al método 'guardar' del controlador, pasando los datos del formulario y la ruta de la imagen
        $obj->guardar($id, $nombre, $cantidad, $precio, $disponible, $descripcion,  "imagenes/" . $archivoNombre);
    } else {
        // Si no hay imagen, llama al método 'guardar' del controlador sin el argumento de la imagen
        $obj->guardar($id, $nombre, $cantidad, $precio, $disponible,$descripcion);
    }
} else {
    echo "Error: No se ha enviado el formulario correctamente o no se ha seleccionado ningún archivo.";
}
?>





