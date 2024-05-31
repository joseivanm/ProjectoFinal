<?php

class CarritoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerDetallesCarrito()
    {
        try {
            // Query para obtener los detalles del carrito
            $sql = "SELECT * FROM carrito";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            // Obtener los resultados como un array asociativo
            $detallesCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $detallesCarrito;
        } catch (PDOException $e) {
            // Manejar errores de la base de datos si es necesario
            // Por ejemplo, puedes registrar el error y devolver un array vacío o false
            error_log("Error al obtener detalles del carrito: " . $e->getMessage(), 0);
            return array();
        }
    }
        // Método para obtener los detalles del carrito por usuario
    public function obtenerDetallesCarritoPorUsuario($idUsuario)
    {
        try {
            // Query para obtener los detalles del carrito por usuario
            $sql = "SELECT * FROM carrito WHERE usuario_id = :idUsuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
    
            // Obtener los resultados como un array asociativo
            $detallesCarrito = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                return $detallesCarrito;
            } catch (PDOException $e) {
                // Manejar errores de la base de datos si es necesario
                // Por ejemplo, puedes registrar el error y devolver un array vacío o false
                error_log("Error al obtener detalles del carrito por usuario: " . $e->getMessage(), 0);
                return array();
            }
    
    }
    
    

    // Puedes agregar otros métodos según tus necesidades
}

?>
