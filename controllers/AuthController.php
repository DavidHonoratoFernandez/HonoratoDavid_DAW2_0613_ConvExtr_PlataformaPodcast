<?php
// Requerimos el modelo que acabamos de crear
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // --- FUNCIÓN DE LOGIN ---
    public function login() {
        // Comprobamos si el usuario ha pulsado el botón "Enviar" (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Llamamos a nuestro modelo para verificar
            $loggedUser = $this->userModel->login($email, $password);

            if ($loggedUser) {
                // ¡Login exitoso! Guardamos los datos nativos de la sesión
                $_SESSION['user_id'] = $loggedUser['id'];
                $_SESSION['user_name'] = $loggedUser['name'];
                $_SESSION['rol'] = $loggedUser['rol'];

                // Redirigimos al catálogo privado de podcasts
                header("Location: index.php?controller=Podcast&action=index");
                exit();
            } else {
                // Si falla, preparamos un mensaje de error y volvemos a cargar la vista
                $error = "Credenciales incorrectas o usuario inexistente.";
                require_once 'views/auth/login.php';
            }
        } else {
            // Si entra por GET (simplemente escribiendo la URL), le mostramos el formulario vacío
            require_once 'views/auth/login.php';
        }
    }

    // --- FUNCIÓN DE REGISTRO ---
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if ($this->userModel->register($name, $email, $password)) {
                // Registro exitoso, redirigimos al login con un mensaje de éxito en la URL
                header("Location: index.php?controller=Auth&action=login&success=1");
                exit();
            } else {
                $error = "El correo ya está en uso o hubo un error.";
                require_once 'views/auth/register.php';
            }
        } else {
            require_once 'views/auth/register.php';
        }
    }

    // --- FUNCIÓN DE LOGOUT ---
    public function logout() {
        // Destruimos todas las variables de sesión
        session_unset();
        session_destroy();
        
        // Redirigimos de vuelta al login
        header("Location: index.php?controller=Auth&action=login");
        exit();
    }
}
?>