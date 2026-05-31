<?php

require_once 'config/conexion.php';

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {

        // Al instanciar el modelo, nos conectamos a la BBDD automáticamente
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // --- FUNCIÓN DE REGISTRO ---
    public function register($name, $email, $password) {

        // 1. Primero comprobamos que el email no exista ya
        $query_check = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt_check = $this->conn->prepare($query_check);
        $stmt_check->bindParam(":email", $email);
        $stmt_check->execute();
        
        if($stmt_check->rowCount() > 0) {
            return false; // El correo ya está en uso
        }

        // 2. Si no existe, preparamos el INSERT
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, rol) VALUES (:name, :email, :password, 'client')";
        $stmt = $this->conn->prepare($query);

        // 3. Encriptamos la contraseña con bcrypt
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // 4. Vinculamos los datos
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hashed);

        // 5. Ejecutamos y devolvemos true si ha ido bien
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // --- FUNCIÓN DE LOGIN ---
    public function login($email, $password) {

        // 1. Buscamos al usuario por su email
        $query = "SELECT id, name, email, password, rol FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // 2. Si el usuario existe, comprobamos la contraseña
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Comparamos el texto plano del formulario con el hash de la BBDD
            if (password_verify($password, $row['password'])) {
  
              // Si coincide, devolvemos todos los datos del usuario
                return $row; 
            }
        }
        
        // Si el correo no existe o la contraseña está mal, devolvemos false
        return false; 
    }


    
    // --- FUNCIONES DE ADMINISTRACIÓN (CRUD ADMIN) ---

    public function guardar($name, $email, $password, $rol) {
        // 1. Comprobamos que el email no exista ya
        $query_check = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt_check = $this->conn->prepare($query_check);
        $stmt_check->bindParam(":email", $email);
        $stmt_check->execute();
        
        if($stmt_check->rowCount() > 0) {
            return false; // El correo ya existe
        }

        // 2. Insertamos con el rol que elija el admin
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, rol) VALUES (:name, :email, :password, :rol)";
        $stmt = $this->conn->prepare($query);

        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hashed);
        $stmt->bindParam(":rol", $rol);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT id, name, email, rol FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $rol, $password = null) {
        if (!empty($password)) {
            // Si el admin escribe contraseña nueva, la actualizamos
            $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, rol = :rol, password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $password_hashed);
        } else {
            // Si la deja en blanco, actualizamos el resto
            $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, rol = :rol WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":rol", $rol);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>