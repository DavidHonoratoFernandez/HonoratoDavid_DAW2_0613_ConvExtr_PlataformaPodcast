<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Podcast Platform</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Crear Cuenta</h2>
            
            <?php if (isset($error)): ?>
                <div class="mensaje-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controller=Auth&action=register" method="POST" class="formulario-auth">
                <div class="grupo-input">
                    <label for="nombre">Nombre de usuario</label>
                    <input type="text" id="nombre" name="nombre" class="input-auth" placeholder="Tu nombre">
                </div>

                <div class="grupo-input">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="input-auth" placeholder="tu@email.com">
                </div>

                <div class="grupo-input">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="input-auth" placeholder="••••••••">
                </div>

                <button type="submit" class="boton boton-auth">Registrarse</button>
            </form>

            <a href="index.php?controller=Auth&action=login" class="enlace-auth">
                ¿Ya tienes cuenta? <strong style="color: var(--color-primario);">Inicia sesión</strong>
            </a>
        </div>
    </div>
</body>
</html>