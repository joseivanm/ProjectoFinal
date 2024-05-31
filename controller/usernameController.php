<?php
if (session_status() === PHP_SESSION_NONE) {session_start();}//A la hora de cargar el administrado que ha subido el 
//el producto da error si no pongo esto, no pasa la variable por la sesion no se porque

class usernameController {
    // Propiedad privada para almacenar la instancia del modelo
    private $model;

    // Constructor que carga la clase del modelo
    public function __construct() {
        // Requiere el archivo del modelo y crea una instancia
        require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/model/usernameModel.php");
        $this->model = new usernameModel();
    }

    public function guardar($id, $nombre, $cantidad, $precio, $disponible, $descripcion, $imagenNombre = NULL) {
        // ... (tu código existente)
        $adminId = $_SESSION['usuario']['id'];
        // Verifica si el formulario se ha enviado y si se ha cargado una imagen
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            // Obtener la información del archivo
            $archivoNombre = $_FILES["imagen"]["name"];
            $archivoTmp = $_FILES["imagen"]["tmp_name"];

            // Resto del código para procesar los otros campos del formulario
            // ...

            // Llama al método 'guardar' del modelo, pasando los datos del formulario y la ruta de la imagen
            return ($this->model->insertar($id, $nombre, $cantidad, $precio, $disponible, $descripcion,$archivoNombre,$adminId)!= false) ? header("Location:lista_productos.php") : header("Location:index.php");
        } else {
            // Si no hay imagen, llama al método 'guardar' del modelo sin el argumento de la imagen
            return  ($this->model->insertar($id, $nombre, $cantidad, $precio, $disponible, $descripcion, $imagenNombre,$adminId)!= false) ? header("Location:lista_productos.php") : header("Location:index.php");
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

    
    public function update($id, $nombre, $cantidad, $precio, $disponible,  $descripcion, $imagenNombre = NULL) {
        
        // ... (tu código existente)

        // Verifica si el formulario se ha enviado y si se ha cargado una imagen
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            // Obtener la información del archivo
            $archivoNombre = $_FILES["imagen"]["name"];
            $archivoTmp = $_FILES["imagen"]["tmp_name"];

            // Resto del código para procesar los otros campos del formulario
            // ...

            // Llama al método 'guardar' del modelo, pasando los datos del formulario y la ruta de la imagen
            return ($this->model->update($id, $nombre, $cantidad, $precio, $disponible,$descripcion, $archivoNombre)!= false) ? header("Location:index.php") : header("Location:lista_productos.php");
        } else {
            // Si no hay imagen, llama al método 'guardar' del modelo sin el argumento de la imagen
            return  ($this->model->update($id, $nombre, $cantidad, $precio, $disponible ,$descripcion, $imagenNombre = NULL)!= false) ? header("Location:index.php") : header("Location:lista_productos.php");
        }
    }
    

    // Método para eliminar información basada en el id
    public function delete($id) {
        return ($this->model->delete($id)) ? header("Location:lista_productos.php") : header("Location:show.php?id=".$id);
    }
    public function reactivar($id) {
        return ($this->model->reactivar($id)) ? header("Location:lista_productos.php") : header("Location:show.php?id=".$id);
    }

    public function obtenerProductoPorId($id)
    {
        return $this->model->obtenerProductoPorId($id);
    }

    public function sumarCantidad($id) {
        // Obtener el producto por su ID
        $producto = $this->model->obtenerProductoPorId($id);
        if ($producto) {
            // Incrementar la cantidad disponible del producto
            $nuevaCantidad = 30 + 1;
            // Actualizar la cantidad en la base de datos
            $resultado = $this->model->actualizarCantidad($id, $nuevaCantidad);
            if ($resultado) {
                // Operación exitosa
                echo "Cantidad sumada correctamente.";
            } else {
                // Error al actualizar la cantidad
                echo "Error al actualizar la cantidad disponible del producto.";
            }
        } else {
            // Producto no encontrado
            echo "Error: Producto no encontrado.";
        }
    }
    

    public function restarCantidad($id) {
        // Obtener el producto por su ID
        $producto = $this->model->obtenerProductoPorId($id);
        
        if ($producto && $producto['cantidad'] > 0) {
            // Decrementar la cantidad disponible del producto
            $nuevaCantidad = $producto['cantidad'] - 1;
            // Actualizar la cantidad en la base de datos
            $resultado = $this->model->actualizarCantidad($id, $nuevaCantidad);
            if ($resultado) {
                // Operación exitosa
                echo json_encode(['success' => true]);
            } else {
                // Error al actualizar la cantidad
                echo json_encode(['success' => false]);
            }
        } else {
            // Producto no encontrado o cantidad ya es cero
            echo json_encode(['success' => false]);
        }
    }
}
?>
