<?php
require_once 'models/Podcast.php';

class PodcastController {
    private $podcastModel;

    public function __construct() {

        // Instanciamos el modelo al llamar al controlador
        $this->podcastModel = new Podcast();

    }

    public function index() {

        // 1. Pedimos todos los podcasts al modelo
        $podcasts = $this->podcastModel->getAll();

        // 2. Cargamos la vista pasándole los datos (mañana crearemos este archivo)
        require_once 'views/podcast/index.php';

    }

    // --- MOSTRAR DETALLES Y EPISODIOS DE UN PODCAST ---
    public function show() {
        // Comprobamos si nos han pasado un ID por la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // 1. Pedimos los datos del podcast al modelo
            $podcast = $this->podcastModel->getById($id);
            
            // 2. Pedimos los episodios de ese podcast
            $episodios = $this->podcastModel->getEpisodes($id);

            // 3. Si el podcast existe, cargamos la vista. Si no, error.
            if ($podcast) {
                require_once 'views/podcast/show.php';
            } else {
                die("Error: El podcast solicitado no existe.");
            }
        } else {
            // Si alguien intenta entrar a 'show' sin pasar un ID, lo mandamos al catálogo
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }
    }

    // --- MÉTODOS DEL CRUD (Solo Admin) ---
    public function crear() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }
        require 'views/podcast/crear.php';
    }

    public function guardar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $creador = trim($_POST['creador'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $categoria = trim($_POST['categoria'] ?? '');
            $portada = trim($_POST['portada'] ?? '');

            if (empty($titulo) || empty($creador) || empty($descripcion) || empty($categoria) || empty($portada)) {
                $error = "Todos los campos son obligatorios.";
                require 'views/podcast/crear.php';
                return;
            }

            $podcast = new Podcast();
            $podcast->guardar($titulo, $creador, $descripcion, $categoria, $portada);
            header("Location: index.php?controller=Admin&action=index");
            exit();
        }
    }

    public function editar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=Admin&action=index");
            exit();
        }

        $id = $_GET['id'];
        $podcastModel = new Podcast();
        $podcast = $podcastModel->getById($id);

        if ($podcast) {
            require 'views/podcast/editar.php';
        } else {
            header("Location: index.php?controller=Admin&action=index");
            exit();
        }
    }

    public function actualizar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_podcast'];
            $titulo = trim($_POST['titulo'] ?? '');
            $creador = trim($_POST['creador'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $categoria = trim($_POST['categoria'] ?? '');
            $portada = trim($_POST['portada'] ?? '');

            $podcastModel = new Podcast();
            $podcastModel->update($id, $titulo, $creador, $descripcion, $categoria, $portada);
            
            header("Location: index.php?controller=Admin&action=index");
            exit();
        }
    }

    public function eliminar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php?controller=Podcast&action=index");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=Admin&action=index");
            exit();
        }

        $id = $_GET['id'];
        $podcastModel = new Podcast();
        $podcastModel->delete($id);
        header("Location: index.php?controller=Admin&action=index");
        exit();
    }
}
?>