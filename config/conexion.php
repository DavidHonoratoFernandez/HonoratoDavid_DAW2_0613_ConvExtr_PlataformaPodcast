<?php
class Database {
    private $srv_name = "localhost";
    private $db_username = "root";
    private $db_passwd = "";
    private $db_name = "db_podcast";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->srv_name . ";dbname=" . $this->db_name, $this->db_username, $this->db_passwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error en la conexión con el server de datos: " . $e->getMessage();
            die();
        }
        return $this->conn;
    }
}
?>