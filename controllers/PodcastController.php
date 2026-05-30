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
}
?>