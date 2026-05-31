<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor">
        <header class="cabecera-principal">
            <h1>Panel de Control</h1>
            <a href="index.php?controller=Podcast&action=index" class="boton-secundario">Salir al Catálogo</a>
        </header>

        <div class="menu-interno-admin">
            <a href="index.php?controller=Admin&action=index" class="boton-secundario">Podcasts</a>
            <a href="index.php?controller=Admin&action=usuarios" class="boton">Usuarios</a>
            <a href="index.php?controller=Admin&action=episodios" class="boton-secundario">Episodios</a>
        </div>

        <div class="panel-gestion">
            <div class="cabecera-gestion">
                <h2>Gestión de Usuarios</h2>
                <a href="index.php?controller=Usuario&action=crear" class="boton boton-pequeno">+ Nuevo Usuario</a>
            </div>

            <table class="tabla-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="alinear-derecha">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td class="texto-bold"><?= htmlspecialchars($usuario['name']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td class="<?= $usuario['rol'] === 'admin' ? 'texto-oro texto-bold' : '' ?>">
                                <?= htmlspecialchars(ucfirst($usuario['rol'])) ?>
                            </td>
                            <td class="alinear-derecha">
                                <a href="index.php?controller=Usuario&action=editar&id=<?= $usuario['id'] ?>" class="boton-secundario boton-pequeno">Editar</a>
                                <?php 
                                // Ajusta $_SESSION['usuario']['id'] según cómo guardes la sesión en tu AuthController
                                $id_sesion = $_SESSION['usuario']['id'] ?? 0; 
                                if ($usuario['id'] != $id_sesion): 
                                ?>
                                    <a href="index.php?controller=Usuario&action=eliminar&id=<?= $usuario['id'] ?>" class="enlace-eliminar" onclick="return confirm('¿Borrar este usuario? Esta acción es irreversible.')">Eliminar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="texto-centrado">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>