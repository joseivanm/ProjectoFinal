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

    
    public function insertar($id, $titulo, $imagenNombre = null, $descripcion, $adminId, $tiempo) {
        // Lógica para la inserción de datos y manejo de imágenes si es necesario
        $statement = $this->PDO->prepare("INSERT INTO recetas (titulo, imagen, descripcion, adminId, fecha_carga, Tiempo) VALUES (:titulo, :imagen, :descripcion, :adminId , NOW(), :Tiempo)");
    
        $statement->bindParam(":titulo", $titulo);
        $statement->bindParam(":imagen", $imagenNombre);
        $statement->bindParam(":descripcion", $descripcion); 
        $statement->bindParam(":adminId", $adminId);
        $statement->bindParam(":Tiempo", $tiempo);

        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;

    }


    // Método para obtener información basada en el id
    public function show($id) {
        $statement = $this->PDO->prepare("SELECT * FROM recetas WHERE id = :id LIMIT 1");
        $statement->bindParam(":id", $id);
        return ($statement->execute()) ? $statement->fetch() : false;
    }

    // Método para obtener la lista completa de registros
    public function index() {
        $statement = $this->PDO->prepare("SELECT * FROM recetas");
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    public function update($id, $titulo, $imagenNombre = NULL, $descripcion, $adminId, $tiempo)
    {
        if($imagenNombre == NULL){$statement = $this->PDO->prepare("UPDATE recetas SET titulo = :titulo, descripcion = :descripcion, adminId = :adminId , fecha_carga = NOW(), Tiempo = :Tiempo WHERE id = :id");}
        else{
            $statement = $this->PDO->prepare("UPDATE recetas SET titulo = :titulo,  imagen = :imagen, descripcion = :descripcion, adminId = :adminId , fecha_carga = NOW(), Tiempo = :Tiempo WHERE id = :id");
            $statement->bindParam(":imagen", $imagenNombre);
        }
        $statement->bindParam(":titulo", $titulo);
        $statement->bindParam(":descripcion", $descripcion); 
        $statement->bindParam(":adminId", $adminId);
        $statement->bindParam(":Tiempo", $tiempo);
        $statement->bindParam(":id", $id);
        
        return ($statement->execute()) ? true : false;
    }

    // Método para eliminar un registro basado en el id
    public function delete($id) {
        $stament = $this->PDO->prepare("DELETE FROM recetas WHERE id = :id");
        $stament->bindParam(":id", $id);
        return ($stament->execute()) ? true : false;
    }
}
?>
