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

    public function getForSelect() {
        $query = "SELECT id_podcast, titulo FROM " . $this->table_name . " ORDER BY titulo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- OBTENER UN PODCAST POR SU ID ---
    public function getById($id) {

        $query = "SELECT * FROM " . $this->table_name . " WHERE id_podcast = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve solo un registro
    }

    // --- OBTENER LOS EPISODIOS DE UN PODCAST ---
    public function getEpisodes($podcast_id) {

        $query = "SELECT * FROM tbl_episodio WHERE fk_id_podcast = :podcast_id ORDER BY fecha_pub DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":podcast_id", $podcast_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve varios registros
    }

    // --- GUARDAR UN NUEVO PODCAST ---
    public function guardar($titulo, $creador, $descripcion, $categoria, $portada) {
    $sql = "INSERT INTO tbl_podcast (titulo, creador, descripcion, categoria, portada) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$titulo, $creador, $descripcion, $categoria, $portada]);
    
}
}
?>