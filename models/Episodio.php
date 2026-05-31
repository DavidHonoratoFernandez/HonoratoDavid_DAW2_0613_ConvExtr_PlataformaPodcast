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
}
?>