<?php
/** @var array $episodio */
/** @var array[] $podcasts */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Episodio - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Editar Episodio</h2>
            
            <form action="index.php?controller=Episodio&action=actualizar" method="POST" class="formulario-auth grid-formulario">
                <input type="hidden" name="id_episodio" value="<?= $episodio['id_episodio'] ?>">
                
                <div class="grupo-input full-width">
                    <label>Podcast al que pertenece</label>
                    <select name="fk_id_podcast" class="input-auth">
                        <option value="">-- Selecciona un Podcast --</option>
                        <?php foreach ($podcasts as $podcast): ?>
                            <option value="<?= $podcast['id_podcast'] ?>" <?= ($podcast['id_podcast'] == $episodio['fk_id_podcast']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($podcast['titulo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grupo-input full-width">
                    <label>Título del Episodio</label>
                    <input type="text" name="titulo" class="input-auth" value="<?= htmlspecialchars($episodio['titulo']) ?>">
                </div>

                <div class="grupo-input">
                    <label>Duración (HH:MM:SS)</label>
                    <input type="time" step="1" name="duracion" class="input-auth" value="<?= htmlspecialchars($episodio['duracion']) ?>">
                </div>

                <div class="grupo-input">
                    <label>Fecha de Publicación</label>
                    <input type="date" name="fecha_pub" class="input-auth" value="<?= htmlspecialchars($episodio['fecha_pub']) ?>">
                </div>

                <div class="grupo-input full-width">
                    <label>URL del Archivo de Audio</label>
                    <input type="file" name="archivo_audio" class="input-auth" value="<?= htmlspecialchars($episodio['archivo_audio']) ?>">
                </div>

                <div class="grupo-input full-width acciones-cabecera">
                    <button type="submit" class="boton full-width">Actualizar Episodio</button>
                    <a href="index.php?controller=Admin&action=episodios" class="boton-secundario full-width">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>