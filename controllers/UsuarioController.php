<?php
require_once 'models/User.php';

class UsuarioController {
    
    public function crear() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        require 'views/admin/usuario/crear.php';
    }

    public function guardar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $rol = $_POST['rol'] ?? 'client';

            if (empty($name) || empty($email) || empty($password)) {
                $error = "Nombre, email y contraseña son obligatorios.";
                require 'views/admin/usuario/crear.php';
                return;
            }

            $usuario = new User();
            $usuario->guardar($name, $email, $password, $rol);
            
            header("Location: index.php?controller=Admin&action=usuarios");
            exit();
        }
    }

    public function editar($id) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        
        $usuarioModel = new User();
        $usuario = $usuarioModel->getById($id);
        
        if ($usuario) {
            require 'views/admin/usuario/editar.php';
        } else {
            header("Location: index.php?controller=Admin&action=usuarios");
            exit();
        }
    }

    public function actualizar() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $rol = $_POST['rol'] ?? 'client';
            $password = trim($_POST['password'] ?? '');

            $usuarioModel = new User();
            $usuarioModel->update($id, $name, $email, $rol, $password);
            
            header("Location: index.php?controller=Admin&action=usuarios");
            exit();
        }
    }

    public function eliminar($id) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        
        $usuarioModel = new User();
        $usuarioModel->delete($id);
        
        header("Location: index.php?controller=Admin&action=usuarios");
        exit();
    }
}
?>