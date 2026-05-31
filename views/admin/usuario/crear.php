<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Crear nuevo Usuario</h2>
            
            <?php if (isset($error)): ?>
                <div class="mensaje-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php?controller=Usuario&action=guardar" method="POST" class="formulario-auth grid-formulario">
                
                <div class="grupo-input full-width">
                    <label>Nombre de usuario</label>
                    <input type="text" name="name" class="input-auth">
                </div>

                <div class="grupo-input full-width">
                    <label>Email</label>
                    <input type="email" name="email" class="input-auth">
                </div>

                <div class="grupo-input">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="input-auth">
                </div>

                <div class="grupo-input">
                    <label>Rol</label>
                    <select name="rol" class="input-auth">
                        <option value="client">Cliente (Normal)</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div class="grupo-input full-width acciones-cabecera">
                    <button type="submit" class="boton full-width">Guardar Usuario</button>
                    <a href="index.php?controller=Admin&action=usuarios" class="boton-secundario full-width">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>