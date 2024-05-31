<?php
require_once("../../config/db.php");
require_once("../../model/usuarioModel.php");

class UsuarioController
{
    private $usuarioModel;

    public function __construct()
    {
        $con = new db();
        $pdo = $con->conexion();
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function index()
    {
        return $this->usuarioModel->obtenerUsuarios();
    }

    public function obtenerUsuarioPorId($id)
    {
        return $this->usuarioModel->obtenerUsuarioPorId($id);
    }

    public function actualizarUsuario($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaPassword = NULL, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol)
    {
    
        // Realizar la consulta de actualización
          // Iniciar el buffer de salida
          ob_start();
        if(!$nuevaPassword == NULL){
        $result = $this->usuarioModel->actualizarUsuario($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaPassword, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol);
         
            // Redirigir según el resultado de la actualización
            if ($result != false) {
                header("Location: lista_productos.php");
            } else {
                header("Location: index.php");
            }
        }
        else{
            $result = $this->usuarioModel->actualizarUsuarioSinPass($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol);
         
            // Redirigir según el resultado de la actualización
            if ($result != false) {
                header("Location: lista_productos.php");
            } else {
                header("Location: index.php");
            }
        }
        
    
        // Finalizar el buffer de salida y enviar la salida
        ob_end_flush();

    }
    public function actualizarUsuarioporAdmin($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol)
    {
        // Iniciar el buffer de salida
        ob_start();
    
        // Realizar la consulta de actualización
        $result = $this->usuarioModel->actualizarUsuarioporAdmin($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol);
    
        // Redirigir según el resultado de la actualización
        if ($result != false) {
            header("Location: lista_productos.php");
        } else {
            header("Location: index.php");
        }
    
        // Finalizar el buffer de salida y enviar la salida
        ob_end_flush();
    }
    

    public function crearUsuario($nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaPassword, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol = 'usuario')
    {
        if (!$this->existeEmail($nuevoEmail) && !$this->existeAlias($nuevoAlias) && !$this->existeTelefono($nuevoTelefono)) {
            $idUsuarioCreado = $this->usuarioModel->crearUsuario($nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaPassword, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol);
            if ($idUsuarioCreado !== false) {
                
            } else {
                
            }
        } else {
            echo "El email o el alias ya están en uso.";
        }
    }

    public function delete($id)
    {
        return ($this->usuarioModel->delete($id)) ? true : false;
    }

    public function existeEmail($email, $id = null)
    {
        return $this->usuarioModel->existeEmail($email, $id);
    }

    public function existeAlias($alias, $id = null)
    {
        return $this->usuarioModel->existeAlias($alias, $id);
    }
    public function existeTelefono($telefono, $id = null)
    {
        return $this->usuarioModel->existeTelefono($telefono, $id);
    }
}
?>
