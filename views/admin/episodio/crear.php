<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Episodio - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Publicar nuevo Episodio</h2>
            
            <?php if (isset($error)): ?>
                <div class="mensaje-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php?controller=Episodio&action=guardar" method="POST" class="formulario-auth grid-formulario">
                
                <div class="grupo-input full-width">
                    <label>Podcast al que pertenece</label>
                    <select name="fk_id_podcast" class="input-auth" required>
                        <option value="">-- Selecciona un Podcast --</option>
                        <?php foreach ($podcasts as $podcast): ?>
                            <option value="<?= $podcast['id_podcast'] ?>">
                                <?= htmlspecialchars($podcast['titulo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grupo-input full-width">
                    <label>Título del Episodio</label>
                    <input type="text" name="titulo" class="input-auth" required>
                </div>

                <div class="grupo-input">
                    <label>Duración (HH:MM:SS)</label>
                    <input type="time" step="1" name="duracion" class="input-auth" required>
                </div>

                <div class="grupo-input">
                    <label>Fecha de Publicación</label>
                    <input type="date" name="fecha_pub" class="input-auth" required>
                </div>

                <div class="grupo-input full-width">
                    <label>URL del Archivo de Audio</label>
                    <input type="url" name="archivo_audio" class="input-auth" placeholder="https://ejemplo.com/audio.mp3" required>
                </div>

                <div class="grupo-input full-width acciones-cabecera">
                    <a href="index.php?controller=Admin&action=episodios" class="boton-secundario full-width">Cancelar</a>
                    <button type="submit" class="boton full-width">Guardar Episodio</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>