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
        require_once 'views/podcasts/index.php';
        
    }
}
?>