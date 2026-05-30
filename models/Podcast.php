<?php
require_once 'config/conexion.php';

class Podcast {
    private $conn;
    private $table_name = "tbl_podcast";

    public function __construct() {

        $db = new Database();
        $this->conn = $db->getConnection();
        
    }

    public function getAll() {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_podcast DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>