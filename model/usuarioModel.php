<?php

class UsuarioModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerUsuarios()
    {
        $statement = $this->pdo->query("SELECT * FROM usuarios WHERE estado != 'eliminado'");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaPassword, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol)
    {
        // Si se proporciona una nueva contraseña, se debe hashear antes de actualizarla
        if (!empty($nuevaPassword)) {
            $nuevaPassword = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        }

        $statement = $this->pdo->prepare("UPDATE usuarios SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, telefono = :telefono, alias = :alias, password = COALESCE(:password, password), direccion = :direccion, codigoPostal = :codigoPostal, poblacion = :poblacion, provincia = :provincia, imagen = :imagen, rol = :rol WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":nombre", $nuevoNombre);
        $statement->bindParam(":apellido1", $nuevoPrimerApellido);
        $statement->bindParam(":apellido2", $nuevoSegundoApellido);
        $statement->bindParam(":email", $nuevoEmail);
        $statement->bindParam(":telefono", $nuevoTelefono);
        $statement->bindParam(":alias", $nuevoAlias);
        $statement->bindParam(":password", $nuevaPassword);
        $statement->bindParam(":direccion", $nuevaDireccion);
        $statement->bindParam(":codigoPostal", $nuevoCodigoPostal);
        $statement->bindParam(":poblacion", $nuevaPoblacion);
        $statement->bindParam(":provincia", $nuevaProvincia);
        $statement->bindParam(":imagen", $nuevaImagen);
        $statement->bindParam(":rol", $nuevoRol);
        
        return ($statement->execute()) ? true : false;
    }
    public function actualizarUsuarioSinPass($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol)
    {


        $statement = $this->pdo->prepare("UPDATE usuarios SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, telefono = :telefono, alias = :alias, direccion = :direccion, codigoPostal = :codigoPostal, poblacion = :poblacion, provincia = :provincia, imagen = :imagen, rol = :rol WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":nombre", $nuevoNombre);
        $statement->bindParam(":apellido1", $nuevoPrimerApellido);
        $statement->bindParam(":apellido2", $nuevoSegundoApellido);
        $statement->bindParam(":email", $nuevoEmail);
        $statement->bindParam(":telefono", $nuevoTelefono);
        $statement->bindParam(":alias", $nuevoAlias);;
        $statement->bindParam(":direccion", $nuevaDireccion);
        $statement->bindParam(":codigoPostal", $nuevoCodigoPostal);
        $statement->bindParam(":poblacion", $nuevaPoblacion);
        $statement->bindParam(":provincia", $nuevaProvincia);
        $statement->bindParam(":imagen", $nuevaImagen);
        $statement->bindParam(":rol", $nuevoRol);
        
        return ($statement->execute()) ? true : false;
    }
    public function actualizarUsuarioporAdmin($id, $nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol)
    {


        $statement = $this->pdo->prepare("UPDATE usuarios SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, email = :email, telefono = :telefono, alias = :alias, direccion = :direccion, codigoPostal = :codigoPostal, poblacion = :poblacion, provincia = :provincia, imagen = :imagen, rol = :rol WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":nombre", $nuevoNombre);
        $statement->bindParam(":apellido1", $nuevoPrimerApellido);
        $statement->bindParam(":apellido2", $nuevoSegundoApellido);
        $statement->bindParam(":email", $nuevoEmail);
        $statement->bindParam(":telefono", $nuevoTelefono);
        $statement->bindParam(":alias", $nuevoAlias);
        $statement->bindParam(":direccion", $nuevaDireccion);
        $statement->bindParam(":codigoPostal", $nuevoCodigoPostal);
        $statement->bindParam(":poblacion", $nuevaPoblacion);
        $statement->bindParam(":provincia", $nuevaProvincia);
        $statement->bindParam(":imagen", $nuevaImagen);
        $statement->bindParam(":rol", $nuevoRol);
        
        return ($statement->execute()) ? true : false;
    }

    public function crearUsuario($nuevoNombre, $nuevoPrimerApellido, $nuevoSegundoApellido, $nuevoEmail, $nuevoTelefono, $nuevoAlias, $nuevaPassword, $nuevaDireccion, $nuevoCodigoPostal, $nuevaPoblacion, $nuevaProvincia, $nuevaImagen, $nuevoRol)
    {
        $hashedPassword = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare("INSERT INTO usuarios (nombre, apellido1, apellido2, email, telefono, alias, password, direccion, codigoPostal, poblacion, provincia, imagen, rol) VALUES (:nombre, :apellido1, :apellido2, :email, :telefono, :alias, :password, :direccion, :codigoPostal, :poblacion, :provincia, :imagen, :rol)");
        $statement->bindParam(":nombre", $nuevoNombre);
        $statement->bindParam(":apellido1", $nuevoPrimerApellido);
        $statement->bindParam(":apellido2", $nuevoSegundoApellido);
        $statement->bindParam(":email", $nuevoEmail);
        $statement->bindParam(":telefono", $nuevoTelefono);
        $statement->bindParam(":alias", $nuevoAlias);
        $statement->bindParam(":password", $hashedPassword);
        $statement->bindParam(":direccion", $nuevaDireccion);
        $statement->bindParam(":codigoPostal", $nuevoCodigoPostal);
        $statement->bindParam(":poblacion", $nuevaPoblacion);
        $statement->bindParam(":provincia", $nuevaProvincia);
        $statement->bindParam(":imagen", $nuevaImagen);
        $statement->bindParam(":rol", $nuevoRol);
        $statement->execute();
    }

    public function delete($id)
    {
        $estado = "eliminado";
        $statement = $this->pdo->prepare("UPDATE usuarios SET estado = :estado WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":estado", $estado);
        return ($statement->execute()) ? true : false;
    }

    public function existeEmail($email, $id = null)
    {
        $query = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        if ($id !== null) {
            $query .= " AND id != :id";
        }

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(":email", $email);
        if ($id !== null) {
            $statement->bindParam(":id", $id);
        }
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    public function existeAlias($alias, $id = null)
    {
        $query = "SELECT COUNT(*) FROM usuarios WHERE alias = :alias";
        if ($id !== null) {
            $query .= " AND id != :id";
        }

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(":alias", $alias);
        if ($id !== null) {
            $statement->bindParam(":id", $id);
        }
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    public function existeTelefono($telefono, $id = null)
    {
        $query = "SELECT COUNT(*) FROM usuarios WHERE telefono = :telefono";
        if ($id !== null) {
            $query .= " AND id != :id";
        }

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(":telefono", $telefono);
        if ($id !== null) {
            $statement->bindParam(":id", $id);
        }
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }
}
?>
