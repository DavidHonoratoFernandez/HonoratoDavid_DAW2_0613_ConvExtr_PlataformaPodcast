<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Podcast Platform</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="contenedor contenedor-auth">
        <div class="tarjeta tarjeta-auth">
            <h2>Bienvenido de nuevo</h2>
            
            <?php if (isset($error)): ?>
                <div class="mensaje-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controller=Auth&action=login" method="POST" class="formulario-auth">
                <div class="grupo-input">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="input-auth" placeholder="tu@email.com">
                </div>

                <div class="grupo-input">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="input-auth" placeholder="••••••••">
                </div>

                <button type="submit" class="boton boton-auth">Entrar</button>
            </form>

            <a href="index.php?controller=Auth&action=register" class="enlace-auth">
                ¿No tienes cuenta? <strong style="color: var(--color-primario);">Regístrate aquí</strong>
            </a>
        </div>
    </div>
</body>
</html>