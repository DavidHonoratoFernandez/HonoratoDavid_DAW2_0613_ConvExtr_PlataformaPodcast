<?php
require_once 'config/conexion.php';

class Episodio {
    public $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function guardar($fk_id_podcast, $titulo, $duracion, $fecha_pub, $archivo_audio) {
        $sql = "INSERT INTO tbl_episodio (fk_id_podcast, titulo, duracion, fecha_pub, archivo_audio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$fk_id_podcast, $titulo, $duracion, $fecha_pub, $archivo_audio]);
    }

    public function getById($id) {
        $sql = "SELECT * FROM tbl_episodio WHERE id_episodio = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $fk_id_podcast, $titulo, $duracion, $fecha_pub, $archivo_audio) {
        $sql = "UPDATE tbl_episodio SET fk_id_podcast=?, titulo=?, duracion=?, fecha_pub=?, archivo_audio=? WHERE id_episodio=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$fk_id_podcast, $titulo, $duracion, $fecha_pub, $archivo_audio, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM tbl_episodio WHERE id_episodio=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>