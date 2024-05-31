<?php 
class db {
    // Propiedades privadas para la configuración de la conexión a la base de datos
    private $host = "sql207.byethost7.com";
    private $dbname = "b7_35756203_trabajofinal1";
    private $user = "b7_35756203";
    private $password = "mariaunpajote1";

    // Método para establecer la conexión a la base de datos
    public function conexion() {
        try {
            // Crear una instancia de PDO para la conexión a MySQL
            $PDO = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            
            // Devolver la instancia de PDO para su uso posterior
            return $PDO;
        } catch (PDOException $e) {
            // En caso de error, devolver el mensaje de la excepción
            return $e->getMessage();
        }
    }
}
?>