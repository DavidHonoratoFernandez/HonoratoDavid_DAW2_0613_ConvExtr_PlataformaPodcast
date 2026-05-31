<?php
require_once 'models/Podcast.php';
// Aquí requerirás luego los modelos de Usuario, Episodio, etc.

class AdminController {
    public function index() {
        // 1. Portero de discoteca: o eres admin o a la calle
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }
        
        // 2. Sacamos los datos para la tabla usando el método público del modelo
        $podcastModel = new Podcast();
        $podcasts = $podcastModel->getAll();

        // 3. Cargamos la vista desde tu NUEVA carpeta
        require_once 'views/admin/dashboard.php';
    }
    
    public function episodios() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        
        require_once 'models/Episodio.php';
        $episodioModel = new Episodio();
        
        $stmt = $episodioModel->conn->query("SELECT * FROM tbl_episodio ORDER BY id_episodio DESC");
        $episodios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Apuntamos a tu nueva estructura de carpetas
        require_once 'views/admin/episodio/index.php';
    }

    public function usuarios() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        
        // Asumiendo que tu tabla se llama tbl_usuario. 
        // Usamos la conexión directamente para ir rápidos.
        require_once 'config/conexion.php';
        $db = new Database();
        $conn = $db->getConnection();
        
        $stmt = $conn->query("SELECT id, name, email, rol FROM users ORDER BY id DESC");
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Apuntamos a la nueva carpeta que vas a crear
        require_once 'views/admin/usuario/index.php';
    }
}
?>