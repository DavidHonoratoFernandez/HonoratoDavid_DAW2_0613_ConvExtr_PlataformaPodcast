<?php
require_once 'models/Episodio.php';
require_once 'models/Podcast.php';

class EpisodioController {
    
    public function crear() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        // Sacamos los podcasts para el desplegable (select)
        $podcastModel = new Podcast();
        $podcasts = $podcastModel->getForSelect();

        // Apuntamos a tu nueva ruta
        require 'views/admin/episodio/crear.php';
    }

    public function guardar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fk_id_podcast = trim($_POST['fk_id_podcast'] ?? '');
            $titulo = trim($_POST['titulo'] ?? '');
            $duracion = trim($_POST['duracion'] ?? '');
            $fecha_pub = trim($_POST['fecha_pub'] ?? '');
            $archivo_audio = trim($_POST['archivo_audio'] ?? '');

            if (empty($fk_id_podcast) || empty($titulo) || empty($duracion) || empty($fecha_pub) || empty($archivo_audio)) {
                // Si hay error, recargamos la vista de crear con los datos
                $error = "Todos los campos son obligatorios.";
                $podcastModel = new Podcast();
                $podcasts = $podcastModel->getForSelect();
                require 'views/admin/episodio/crear.php';
                return;
            }

            $episodio = new Episodio();
            $episodio->guardar($fk_id_podcast, $titulo, $duracion, $fecha_pub, $archivo_audio);
            
            // Volvemos a la pestaña de episodios
            header("Location: index.php?controller=Admin&action=episodios");
            exit();
        }
    }

    public function editar($id) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        
        $episodioModel = new Episodio();
        $episodio = $episodioModel->getById($id);
        
        if ($episodio) {
            // Necesitamos los podcasts para el desplegable (usar método público del modelo)
            $podcastModel = new Podcast();
            $podcasts = $podcastModel->getForSelect();
            
            require 'views/admin/episodio/editar.php';
        } else {
            header("Location: index.php?controller=Admin&action=episodios");
            exit();
        }
    }

    public function actualizar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_episodio'];
            $fk_id_podcast = trim($_POST['fk_id_podcast'] ?? '');
            $titulo = trim($_POST['titulo'] ?? '');
            $duracion = trim($_POST['duracion'] ?? '');
            $fecha_pub = trim($_POST['fecha_pub'] ?? '');
            $archivo_audio = trim($_POST['archivo_audio'] ?? '');

            $episodioModel = new Episodio();
            $episodioModel->update($id, $fk_id_podcast, $titulo, $duracion, $fecha_pub, $archivo_audio);
            
            header("Location: index.php?controller=Admin&action=episodios");
            exit();
        }
    }

    public function eliminar($id) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        
        $episodioModel = new Episodio();
        $episodioModel->delete($id);
        
        header("Location: index.php?controller=Admin&action=episodios");
        exit();
    }
}
?>