<?php
class usernameModel {
    // Propiedad privada para la conexión a la base de datos
    private $PDO;

    // Constructor que establece la conexión a la base de datos
    public function __construct() {
        // Requiere el archivo de configuración de la base de datos y establece la conexión
        require_once("/home/vol17_1/byethost7.com/b7_35756203/trabajofinal.22web.org/htdocs/config/db.php");
        $con = new db();
        $this->PDO = $con->conexion();
    }

    public function insertar($id, $nombre, $cantidad, $precio, $disponible, $descripcion, $imagenNombre = null,$adminId) {
        $statement = $this->PDO->prepare("INSERT INTO productos (id, nombre, cantidad, precio, disponible, imagen, adminId, fecha_carga, descripcion) VALUES(:id, :nombre, :cantidad, :precio, 1, :imagen, :adminId, NOW(), :descripcion)");


        $statement->bindParam(":id", $id);
        $statement->bindParam(":nombre", $nombre);
        $statement->bindParam(":cantidad", $cantidad);
        $statement->bindParam(":precio", $precio);
        $statement->bindParam(":imagen", $imagenNombre);
        $statement->bindParam(":adminId", $adminId);
        $statement->bindParam(":descripcion", $descripcion);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }


    // Método para obtener información basada en el id
    public function show($id) {
        $statement = $this->PDO->prepare("SELECT * FROM productos WHERE id = :id LIMIT 1");
        $statement->bindParam(":id", $id);
        return ($statement->execute()) ? $statement->fetch() : false;
    }

    // Método para obtener la lista completa de registros
    public function index() {
        $statement = $this->PDO->prepare("SELECT * FROM productos");
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    public function update($id, $nombre, $cantidad, $precio, $disponible,$descripcion, $imagenNombre = NULL)

    {
        $statement = $this->PDO->prepare("UPDATE productos SET nombre = :nombre, cantidad = :cantidad, precio = :precio, disponible = :disponible,  imagen = :imagen, descripcion = :descripcion WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":nombre", $nombre);
        $statement->bindParam(":cantidad", $cantidad);
        $statement->bindParam(":precio", $precio);
        $statement->bindParam(":disponible", $disponible);
        $statement->bindParam(":descripcion", $descripcion);
        if($imagenNombre == NULL){$imagenNombre = $_SESSION['imagen_ruta'];}
        $statement->bindParam(":imagen", $imagenNombre);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }

    // Método para eliminar un registro basado en el id
    public function delete($id) {
        $stament = $this->PDO->prepare("UPDATE productos SET estado = :estado WHERE id = :id");
        $estado = "eliminado";
        $stament->bindParam(":id", $id);
        $stament->bindParam(":estado", $estado);
        return ($stament->execute()) ? true : false;
    }
    public function reactivar($id) {
        $stament = $this->PDO->prepare("UPDATE productos SET estado = :estado WHERE id = :id");
        $estado = "";
        $stament->bindParam(":id", $id);
        $stament->bindParam(":estado", $estado);
        return ($stament->execute()) ? true : false;
    }

    public function obtenerProductoPorId($id)
    {
        $statement = $this->PDO->prepare("SELECT * FROM productos WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCantidad($id, $cantidad) {
        $statement = $this->PDO->prepare("UPDATE productos SET cantidad = cantidad + 1 WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":cantidad", $cantidad);
        return $statement->execute();
    }
    
    public function restarCantidad($id) {
        $statement = $this->PDO->prepare("UPDATE productos SET cantidad = cantidad - 1 WHERE id = :id AND cantidad > 0");
        $statement->bindParam(":id", $id);
        return $statement->execute();
    }
    
}
?>
