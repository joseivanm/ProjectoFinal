<?php
if (session_status() === PHP_SESSION_NONE) {session_start();}//A la hora de cargar el administrado que ha subido el 
//el producto da error si no pongo esto, no pasa la variable por la sesion no se porque

class usernameController {
    // Propiedad privada para almacenar la instancia del modelo
    private $model;

    // Constructor que carga la clase del modelo
    public function __construct() {
        // Requiere el archivo del modelo y crea una instancia
        require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/recetaModel.php");
        $this->model = new usernameModel();
    }

    public function guardar($id, $titulo, $imagenNombre = NULL, $descripcion, $tiempo) {
        // ... (tu código existente)
        $adminId = $_SESSION['usuario']['id'];
        //$adminId = 6;
        // Verifica si el formulario se ha enviado y si se ha cargado una imagen
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            // Obtener la información del archivo
            $archivoNombre = $_FILES["imagen"]["name"];
            $archivoTmp = $_FILES["imagen"]["tmp_name"];

            // Resto del código para procesar los otros campos del formulario
            // ...

            // Llama al método 'guardar' del modelo, pasando los datos del formulario y la ruta de la imagen
           // return ($this->model->insertar($id, $titulo, $archivoNombre,$descripcion, $adminId)!= false) ? header("Location:index.php") : header("Location:indexy.php");
            return ($this->model->insertar($id, $titulo, $archivoNombre,$descripcion, $adminId, $tiempo)!= false) ? header("Location:index.php") : header("");
        } else {
            // Si no hay imagen, llama al método 'guardar' del modelo sin el argumento de la imagen
            return  ($this->model->insertar($id, $titulo, $imagenNombre,$descripcion, $adminId , $tiempo)!= false) ? header("Location:show.php?id=" . $id) : header("Location:index.php");
        }
    }
    

    // Método para mostrar información basada en el id
    public function show($id) {
        // Redirige según el resultado de la operación
        return ($this->model->show($id) != false) ? $this->model->show($id) : header("Location:index.php");
    }

    // Método para mostrar la lista completa de información
    public function index() {
        // Retorna la lista de información desde el modelo
        return ($this->model->index()) ? $this->model->index() : false;
    }

    
   /* public function update($id, $nombre, $disponible, $cantidad, $precio, $imagenNombre = NULL)
    {
        return ($this->model->update($id, $nombre, $disponible, $cantidad, $precio, $imagenNombre) != false) ? header("Location:controlar_usuarios.php") : header("Location:editUsuarios.php?id=" . $id);
    }*/
    public function update($id, $titulo, $imagenNombre = NULL, $descripcion, $tiempo) {
        // ... (tu código existente)
        $adminId = $_SESSION['usuario']['id'];
        // Verifica si el formulario se ha enviado y si se ha cargado una imagen
        if(!$imagenNombre == NULL){
            
                // Llama al método 'guardar' del modelo, pasando los datos del formulario y la ruta de la imagen
                return ($this->model->update($id, $titulo, $imagenNombre,$descripcion, $adminId,$tiempo)!= false) ? header("Location:lista_recetas.php") : header("Location:index.php");
            
        } else {
            // Si no hay imagen, llama al método 'guardar' del modelo sin el argumento de la imagen
            return  ($this->model->update($id, $titulo, $imagenNombre,$descripcion, $adminId,$tiempo)!= false) ? header("Location:lista_recetas.php") : header("Location:index.php");
        }
    }
    

    // Método para eliminar información basada en el id
    public function delete($id) {
        return ($this->model->delete($id)) ? header("Location:lista_recetas.php") : header("Location:showReceta.php?id=".$id);
    }
}
?>
