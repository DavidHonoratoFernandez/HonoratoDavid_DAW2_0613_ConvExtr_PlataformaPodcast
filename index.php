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
            try {
                $ref = new ReflectionMethod($controller, $actionName);
                $required = $ref->getNumberOfRequiredParameters();

                if ($required === 0) {
                    $controller->$actionName();
                } elseif ($required === 1) {
                    if (isset($_GET['id'])) {
                        $controller->$actionName($_GET['id']);
                    } else {
                        die("Error: Falta parámetro 'id' para la acción '$actionName'.");
                    }
                } else {
                    // Para acciones con >1 parámetro, intentamos mapearlos por nombre desde GET
                    $params = [];
                    foreach ($ref->getParameters() as $param) {
                        $pname = $param->getName();
                        if (isset($_GET[$pname])) {
                            $params[] = $_GET[$pname];
                        } elseif ($param->isDefaultValueAvailable()) {
                            $params[] = $param->getDefaultValue();
                        } else {
                            die("Error: Falta parámetro '$pname' para la acción '$actionName'.");
                        }
                    }
                    $ref->invokeArgs($controller, $params);
                }
            } catch (ReflectionException $e) {
                die('Error interno de reflexión: ' . $e->getMessage());
            }
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