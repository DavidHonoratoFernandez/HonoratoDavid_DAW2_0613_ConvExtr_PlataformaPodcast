<?php
// Arrancamos la gestión de sesiones nativa desde el minuto cero
session_start();

// 1. Definir Controlador y Acción por defecto
// Si entramos a la web sin parámetros, por defecto cargará PodcastController y el método index
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'Podcast';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// 2. Formatear el nombre del archivo y la clase
// Convertimos "podcast" en "PodcastController"
$controllerClassName = ucfirst($controllerName) . 'Controller';
$controllerFile = 'controllers/' . $controllerClassName . '.php';

// 3. Comprobar si el archivo del controlador existe
if (file_exists($controllerFile)) {
   
    // Cargamos el archivo
    require_once $controllerFile;

    // 4. Comprobar si la clase existe dentro de ese archivo
    if (class_exists($controllerClassName)) {
        
        // Instanciamos el controlador (ej: $controller = new PodcastController();)
        $controller = new $controllerClassName();

        // 5. Comprobar si el método (la acción) existe en el controlador
        if (method_exists($controller, $actionName)) {
        
            // Llamamos a la función (ej: $controller->index();)
            $controller->$actionName();
        
        } else {
        
            // Error 404 casero: La función no existe
            die("Error: La acción '$actionName' no existe en '$controllerClassName'.");
        
        }
    
    } else {
    
        // Error 404 casero: La clase no existe
        die("Error: La clase '$controllerClassName' no se encuentra.");

    }
} else {

    // Error 404 casero: El archivo no existe
    die("Error: El controlador '$controllerClassName' no existe en la carpeta controllers.");
    
}
?>