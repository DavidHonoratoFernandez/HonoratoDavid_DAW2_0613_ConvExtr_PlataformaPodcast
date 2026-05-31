<?php
/** @var array $podcast */
/** @var array $episodios */
$userName = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($podcast['titulo']) ?> - Podcast Platform</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header class="cabecera-principal">
        <a href="index.php?controller=Podcast&action=index">⬅ Volver al catálogo</a>
        <span>Usuario: <?= htmlspecialchars($userName) ?></span>
    </header>

    <div class="contenedor">
        <div style="margin-bottom: 2rem;">
            <h2 style="font-size: 2rem; color: var(--color-primario);"><?= htmlspecialchars($podcast['titulo']) ?></h2>
            <p style="color: var(--texto-secundario); font-size: 1.1rem;">
                Producido por <strong><?= htmlspecialchars($podcast['creador']) ?></strong> | Categoría: <?= htmlspecialchars($podcast['categoria']) ?>
            </p>
        </div>

        <h3>Episodios Disponibles</h3>
        
        <?php if (!empty($episodios)): ?>
            <ul class="lista-episodios">
                <?php foreach ($episodios as $ep): ?>
                    <li class="item-episodio">
                        <h4><?= htmlspecialchars($ep['titulo']) ?></h4>
                        <p class="info-episodio">
                            📅 <?= htmlspecialchars($ep['fecha_pub']) ?> &nbsp;|&nbsp; ⏱ <?= htmlspecialchars($ep['duracion']) ?>
                        </p>
                        
                        <audio controls>
                            <source src="assets/audios/<?= htmlspecialchars($ep['archivo_audio']) ?>" type="audio/mpeg">
                            Tu navegador no soporta el elemento de audio.
                        </audio>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aún no hay episodios subidos para este canal.</p>
        <?php endif; ?>
    </div>
</body>
</html>