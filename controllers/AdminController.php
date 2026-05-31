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
}
?>