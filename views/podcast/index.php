<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Podcasts</title>
</head>
<body>
    <header style="background-color: #f4f4f4; padding: 10px; margin-bottom: 20px;">
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
        <a href="index.php?controller=Auth&action=logout">Cerrar Sesión</a>
    </header>

    <h2>Catálogo de Canales</h2>

    <div class="podcasts-grid">
        <?php if (!empty($podcasts)): ?>
            <?php foreach ($podcasts as $podcast): ?>
                
                <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px;">
                    <h3><?= htmlspecialchars($podcast['titulo']) ?></h3>
                    <p><strong>Productor:</strong> <?= htmlspecialchars($podcast['creador']) ?></p>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($podcast['categoria']) ?></p>
                    
                    <a href="index.php?controller=Podcast&action=show&id=<?= $podcast['id_podcast'] ?>">Ver episodios y detalles</a>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>Todavía no hay canales de podcast en la plataforma.</p>
        <?php endif; ?>
    </div>
</body>
</html>