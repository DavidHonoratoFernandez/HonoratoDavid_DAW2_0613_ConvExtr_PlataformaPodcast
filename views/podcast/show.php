<?php
/** @var array<string, mixed> $podcast */
/** @var array<int, array<string, mixed>> $episodios */
$userName = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($podcast['titulo']) ?> - Podcast Platform</title>
</head>
<body>
    <header style="background-color: #f4f4f4; padding: 10px; margin-bottom: 20px;">
        <a href="index.php?controller=Podcast&action=index">⬅ Volver al catálogo</a>
        <span style="float: right;">Usuario: <?= htmlspecialchars($userName) ?></span>
    </header>

    <div style="border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 20px;">
        <h2><?= htmlspecialchars($podcast['titulo']) ?></h2>
        <p><strong>Productor:</strong> <?= htmlspecialchars($podcast['creador']) ?></p>
        <p><strong>Categoría:</strong> <?= htmlspecialchars($podcast['categoria']) ?></p>
        </div>

    <h3>Episodios Disponibles</h3>
    
    <?php if (!empty($episodios)): ?>
        <ul style="list-style-type: none; padding: 0;">
            <?php foreach ($episodios as $ep): ?>
                <li style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                    <h4><?= htmlspecialchars($ep['titulo']) ?></h4>
                    <p>
                        📅 <?= htmlspecialchars($ep['fecha_pub']) ?> | 
                        ⏱ <?= htmlspecialchars($ep['duracion']) ?>
                    </p>
                    
                    <audio controls style="width: 100%; margin-top: 10px;">
                        <source src="assets/audios/<?= htmlspecialchars($ep['archivo_audio']) ?>" type="audio/mpeg">
                        Tu navegador no soporta el elemento de audio.
                    </audio>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aún no hay episodios subidos para este canal.</p>
    <?php endif; ?>

</body>
</html>