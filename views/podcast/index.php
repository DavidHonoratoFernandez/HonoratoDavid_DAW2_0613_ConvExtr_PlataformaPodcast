<?php

$userName = $_SESSION['user_name'] ?? '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Podcasts</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header class="cabecera-principal">
        <h1>Bienvenido, <?= htmlspecialchars($userName) ?></h1>
        <a href="index.php?controller=Auth&action=logout" style="color: #ef4444; font-weight: bold;">Cerrar Sesión</a>
    </header>

    <div class="contenedor">
        <h2>Catálogo de Canales</h2>

        <div class="cuadricula-podcasts">
            <?php if (!empty($podcasts)): ?>
                <?php foreach ($podcasts as $podcast): ?>
                    
                    <div class="tarjeta">
                        <h3><?= htmlspecialchars($podcast['titulo']) ?></h3>
                        <p><strong>Productor:</strong> <?= htmlspecialchars($podcast['creador']) ?></p>
                        <p><strong>Categoría:</strong> <?= htmlspecialchars($podcast['categoria']) ?></p>
                        
                        <a href="index.php?controller=Podcast&action=show&id=<?= $podcast['id_podcast'] ?>" class="boton">Ver episodios</a>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>Todavía no hay canales de podcast en la plataforma.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>