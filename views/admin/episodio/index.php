<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Episodios - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor">
        <header class="cabecera-principal">
            <h1>Panel de Control ⚙️</h1>
            <a href="index.php?controller=Podcast&action=index" class="boton-secundario">Salir al Catálogo</a>
        </header>

        <div class="menu-interno-admin">
            <a href="index.php?controller=Admin&action=index" class="boton-secundario">Podcasts</a>
            <a href="index.php?controller=Admin&action=usuarios" class="boton-secundario">Usuarios</a>
            <a href="index.php?controller=Admin&action=episodios" class="boton">Episodios</a>
        </div>

        <div class="panel-gestion">
            <div class="cabecera-gestion">
                <h2>Gestión de Episodios</h2>
                <a href="index.php?controller=Episodio&action=crear" class="boton boton-pequeno">+ Nuevo Episodio</a>
            </div>

            <table class="tabla-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Podcast (ID)</th>
                        <th>Título</th>
                        <th>Fecha Pub.</th>
                        <th class="alinear-derecha">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($episodios)): ?>
                        <?php foreach ($episodios as $episodio): ?>
                        <tr>
                            <td><?= $episodio['id_episodio'] ?></td>
                            <td><?= $episodio['fk_id_podcast'] ?></td>
                            <td class="texto-bold"><?= htmlspecialchars($episodio['titulo']) ?></td>
                            <td><?= htmlspecialchars($episodio['fecha_pub']) ?></td>
                            <td class="alinear-derecha">
                                <a href="index.php?controller=Episodio&action=editar&id=<?= $episodio['id_episodio'] ?>" class="boton-secundario boton-pequeno">Editar</a>
                                <a href="index.php?controller=Episodio&action=eliminar&id=<?= $episodio['id_episodio'] ?>" class="enlace-eliminar" onclick="return confirm('¿Borrar definitivamente?')">Eliminar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem;">No hay episodios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>