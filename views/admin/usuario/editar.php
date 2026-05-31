<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Editar Usuario</h2>
            
            <form action="index.php?controller=Usuario&action=actualizar" method="POST" class="formulario-auth grid-formulario">
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                
                <div class="grupo-input full-width">
                    <label>Nombre de usuario</label>
                    <input type="text" name="name" class="input-auth" value="<?= htmlspecialchars($usuario['name']) ?>">
                </div>

                <div class="grupo-input full-width">
                    <label>Email</label>
                    <input type="email" name="email" class="input-auth" value="<?= htmlspecialchars($usuario['email']) ?>">
                </div>

                <div class="grupo-input">
                    <label>Nueva Contraseña <small class="texto-secundario">(Opcional)</small></label>
                    <input type="password" name="password" class="input-auth" placeholder="Dejar en blanco para no cambiarla">
                </div>

                <div class="grupo-input">
                    <label>Rol</label>
                    <select name="rol" class="input-auth">
                        <option value="client" <?= $usuario['rol'] === 'client' ? 'selected' : '' ?>>Cliente (Normal)</option>
                        <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                    </select>
                </div>

                <div class="grupo-input full-width acciones-cabecera">
                    <a href="index.php?controller=Admin&action=usuarios" class="boton-secundario full-width">Cancelar</a>
                    <button type="submit" class="boton full-width">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>