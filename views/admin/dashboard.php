<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor">
        <header class="cabecera-principal">
            <h1>Panel de Control ⚙️</h1>
            <a href="index.php?controller=Podcast&action=index" class="boton-secundario">Salir al Catálogo</a>
        </header>

        <div class="menu-interno-admin">
            <a href="index.php?controller=Admin&action=index" class="boton">Podcasts</a>
            <a href="index.php?controller=Admin&action=usuarios" class="boton-secundario">Usuarios</a>
            <a href="index.php?controller=Admin&action=episodios" class="boton-secundario">Episodios</a>
        </div>

        <div class="panel-gestion">
            <div class="cabecera-gestion">
                <h2>Gestión de Podcasts</h2>
                <a href="index.php?controller=Podcast&action=crear" class="boton boton-pequeno">+ Nuevo Podcast</a>
            </div>

            <table class="tabla-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th class="alinear-derecha">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($podcasts as $podcast): ?>
                    <tr>
                        <td><?= $podcast['id_podcast'] ?></td>
                        <td class="texto-bold"><?= htmlspecialchars($podcast['titulo']) ?></td>
                        <td><?= htmlspecialchars($podcast['categoria']) ?></td>
                        <td class="alinear-derecha">
                            <a href="index.php?controller=Podcast&action=editar&id=<?= $podcast['id_podcast'] ?>" class="boton-secundario boton-pequeno">Editar</a>
                            <a href="index.php?controller=Podcast&action=eliminar&id=<?= $podcast['id_podcast'] ?>" class="enlace-eliminar" onclick="return confirm('¿Borrar definitivamente?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>