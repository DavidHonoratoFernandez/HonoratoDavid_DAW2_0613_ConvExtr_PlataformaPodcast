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

    /// --- CREAR NUEVO PODCAST (FORMULARIO) ---
    public function crear() {
        require_once 'views/podcast/crear.php';
    }

    public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // 1. Sanitizamos los datos (limpiamos espacios)
        $titulo = trim($_POST['titulo'] ?? '');
        $creador = trim($_POST['creador'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $categoria = trim($_POST['categoria'] ?? '');
        $portada = trim($_POST['portada'] ?? '');

        // 2. Validación: ¿Está todo vacío?
        if (empty($titulo) || empty($creador) || empty($descripcion) || empty($categoria) || empty($portada)) {
            $error = "Todos los campos son obligatorios. Por favor, rellénalos todos.";
            require 'views/podcast/crear.php'; // Volvemos al formulario con el mensaje de error
            return;
        }

        // 3. Si todo está bien, guardamos
        $podcast = new Podcast();
        $podcast->guardar($titulo, $creador, $descripcion, $categoria, $portada);

        header("Location: index.php?controller=Podcast&action=index");
        exit();
    }
}
}
?>