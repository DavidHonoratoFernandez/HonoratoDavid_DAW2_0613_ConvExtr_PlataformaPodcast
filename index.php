<?php
// Inicia sesión (usar `$_SESSION`)
session_start();

// Controlador y acción (GET) — valores por defecto
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'Podcast';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Nombre de clase y ruta del archivo del controlador
$controllerClassName = ucfirst($controllerName) . 'Controller';
$controllerFile = 'controllers/' . $controllerClassName . '.php';

// Incluir controlador si existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Verificar clase y control de acceso
    if (class_exists($controllerClassName)) {
        $paginasPublicas = ['Auth']; // controladores accesibles sin login
        if (!in_array($controllerName, $paginasPublicas) && !isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=Auth&action=login");
            exit();
        }

        // Instanciar y ejecutar acción si existe
        $controller = new $controllerClassName();
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            die("Error: La acción '$actionName' no existe en '$controllerClassName'.");
        }

    } else {
        die("Error: La clase '$controllerClassName' no se encuentra.");
    }

} else {
    die("Error: El controlador '$controllerClassName' no existe en la carpeta controllers.");
}
?>