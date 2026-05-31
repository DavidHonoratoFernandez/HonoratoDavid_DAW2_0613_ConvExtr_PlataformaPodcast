<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Podcast - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Editar Podcast</h2>
            
            <form action="index.php?controller=Podcast&action=actualizar" method="POST" class="formulario-auth grid-formulario">
                <input type="hidden" name="id_podcast" value="<?= $podcast['id_podcast'] ?>">
                
                <div class="grupo-input">
                    <label>Título</label>
                    <input type="text" name="titulo" class="input-auth" value="<?= htmlspecialchars($podcast['titulo']) ?>">
                </div>

                <div class="grupo-input">
                    <label>Creador</label>
                    <input type="text" name="creador" class="input-auth" value="<?= htmlspecialchars($podcast['creador']) ?>">
                </div>

                <div class="grupo-input">
                    <label>Categoría</label>
                    <input type="text" name="categoria" class="input-auth" value="<?= htmlspecialchars($podcast['categoria']) ?>">
                </div>

                <div class="grupo-input">
                    <label>URL Portada</label>
                    <input type="text" name="portada" class="input-auth" value="<?= htmlspecialchars($podcast['portada']) ?>">
                </div>

                <div class="grupo-input full-width">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="input-auth" rows="4"><?= htmlspecialchars($podcast['descripcion']) ?></textarea>
                </div>

                <div class="grupo-input full-width acciones-cabecera">
                    <a href="index.php?controller=Admin&action=index" class="boton-secundario full-width">Cancelar</a>
                    <button type="submit" class="boton full-width">Actualizar Podcast</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>