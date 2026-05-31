<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Podcast - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Publicar nuevo Podcast</h2>
            
            <?php if (isset($error)): ?>
                <div class="mensaje-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php?controller=Podcast&action=guardar" method="POST" class="formulario-auth grid-formulario">
                <div class="grupo-input">
                    <label>Título</label>
                    <input type="text" name="titulo" class="input-auth">
                </div>

                <div class="grupo-input">
                    <label>Creador</label>
                    <input type="text" name="creador" class="input-auth">
                </div>

                <div class="grupo-input">
                    <label>Categoría</label>
                    <input type="text" name="categoria" class="input-auth">
                </div>

                <div class="grupo-input">
                    <label>URL Portada</label>
                    <input type="text" name="portada" class="input-auth">
                </div>

                <div class="grupo-input full-width">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="input-auth" rows="4"></textarea>
                </div>

                <div class="grupo-input full-width acciones-cabecera">
                    <button type="submit" class="boton full-width">Guardar Podcast</button>
                    <a href="index.php?controller=Admin&action=index" class="boton-secundario full-width">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>